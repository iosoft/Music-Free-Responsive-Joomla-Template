var Zepto = (function() {
  var slice = [].slice, key, css, $$, fragmentRE, container, document = window.document, undefined;

  // fix for iOS 3.2
  if (String.prototype.trim === undefined)
    String.prototype.trim = function(){ return this.replace(/^\s+/, '').replace(/\s+$/, '') };

  function classRE(name){ return new RegExp("(^|\\s)" + name + "(\\s|$)") }
  function compact(array){ return array.filter(function(item){ return item !== undefined && item !== null }) }
  function flatten(array){ return array.reduce(function(a,b){ return a.concat(b) }, []) }
  function camelize(str){ return str.replace(/-+(.)?/g, function(match, chr){ return chr ? chr.toUpperCase() : '' }) }

  fragmentRE = /^\s*<.+>/;
  container = document.createElement("div");
  function fragment(html) {
    container.innerHTML = ('' + html).trim();
    var result = slice.call(container.childNodes);
    container.innerHTML = '';
    return result;
  }

  function Z(dom, selector){
    this.dom = dom || [];
    this.length = this.dom.length;
    this.selector = selector || '';
  }

  function $(selector, context){
    if (selector == document) return new Z;
    else if (context !== undefined) return $(context).find(selector);
    else if (typeof selector === 'function') return $(document).ready(selector);
    else {
      var dom;
      if (selector instanceof Z) dom = selector.dom;
      else if (selector instanceof Array) dom = compact(selector);
      else if (selector instanceof Element || selector === window) dom = [selector];
      else if (fragmentRE.test(selector)) dom = fragment(selector);
      else dom = $$(document, selector);

      return new Z(dom, selector);
    }
  }

  $.extend = function(target, source){ for (key in source) target[key] = source[key]; return target }
  $.qsa = $$ = function(element, selector){ return slice.call(element.querySelectorAll(selector)) }

  $.fn = {
    ready: function(callback){
      document.addEventListener('DOMContentLoaded', callback, false); return this;
    },
    get: function(idx){ return idx === undefined ? this.dom : this.dom[idx] },
    size: function(){ return this.length },
    remove: function(){ return this.each(function(){ this.parentNode.removeChild(this) }) },
    each: function(callback){
      this.dom.forEach(function(el, idx){ callback.call(el, idx, el) });
      return this;
    },
    filter: function(selector){
      return $(this.dom.filter(function(element){
        return $$(element.parentNode, selector).indexOf(element) >= 0;
      }));
    },
    is: function(selector){
      return this.length > 0 && $(this.dom[0]).filter(selector).length > 0;
    },
    first: function(){ return $(this.get(0)) },
    last: function(){ return $(this.get(this.length - 1)) },
    find: function(selector){
      var result;
      if (this.length == 1) result = $$(this.get(0), selector);
      else result = flatten(this.dom.map(function(el){ return $$(el, selector) }));
      return $(result);
    },
    closest: function(selector, context){
      var node = this.dom[0], nodes = $$(context !== undefined ? context : document, selector);
      if (nodes.length === 0) node = null;
      while(node && node !== document && nodes.indexOf(node) < 0) node = node.parentNode;
      return $(node);
    },
    parents: function(selector){
      var ancestors = [], nodes = this.get();
      while (nodes.length > 0)
        nodes = compact(nodes.map(function(node){
          if ((node = node.parentNode) && node !== document && ancestors.indexOf(node) < 0) {
            ancestors.push(node);
            return node;
          }
        }));
      ancestors = $(ancestors);
      return selector === undefined ? ancestors : ancestors.filter(selector);
    },
    parent: function(selector){
      var node, nodes = [];
      this.each(function(){
        if ((node = this.parentNode) && nodes.indexOf(node) < 0) nodes.push(node);
      });
      nodes = $(nodes);
      return selector === undefined ? nodes : nodes.filter(selector);
    },
    pluck: function(property){ return this.dom.map(function(element){ return element[property] }) },
    show: function(){ return this.css('display', 'block') },
    hide: function(){ return this.css('display', 'none') },
    prev: function(){ return $(this.pluck('previousElementSibling')) },
    next: function(){ return $(this.pluck('nextElementSibling')) },
    html: function(html){
      return html === undefined ?
        (this.length > 0 ? this.dom[0].innerHTML : null) :
        this.each(function(){ this.innerHTML = html });
    },
    text: function(text){
      return text === undefined ?
        (this.length > 0 ? this.dom[0].innerText : null) :
        this.each(function(){ this.innerText = text });
    },
    attr: function(name, value){
      return (typeof name == 'string' && value === undefined) ?
        (this.length > 0 && this.dom[0].nodeName === 'INPUT' && this.dom[0].type === 'text' && name === 'value') ? (this.dom[0].value) :
        (this.length > 0 ? this.dom[0].getAttribute(name) || undefined : null) :
        this.each(function(){
          if (typeof name == 'object') for (key in name) this.setAttribute(key, name[key])
          else this.setAttribute(name, value);
        });
    },
    offset: function(){
      var obj = this.dom[0].getBoundingClientRect();
      return {
        left: obj.left + document.body.scrollLeft,
        top: obj.top + document.body.scrollTop,
        width: obj.width,
        height: obj.height
      };
    },
    css: function(property, value){
      if (value === undefined && typeof property == 'string') return this.dom[0].style[camelize(property)];
      css = "";
      for (key in property) css += key + ':' + property[key] + ';';
      if (typeof property == 'string') css = property + ":" + value;
      return this.each(function() { this.style.cssText += ';' + css });
    },
    index: function(element){
      return this.dom.indexOf($(element).get(0));
    },
    hasClass: function(name){
      return classRE(name).test(this.dom[0].className);
    },
    addClass: function(name){
      return this.each(function(){
        !$(this).hasClass(name) && (this.className += (this.className ? ' ' : '') + name)
      });
    },
    removeClass: function(name){
      return this.each(function(){
        this.className = this.className.replace(classRE(name), ' ').trim()
      });
    },
    toggleClass: function(name, when){
      return this.each(function(){
       ((when !== undefined && !when) || $(this).hasClass(name)) ?
         $(this).removeClass(name) : $(this).addClass(name)
      });
    }
  };

  ['width', 'height'].forEach(function(property){
    $.fn[property] = function(){ return this.offset()[property] }
  });


  var adjacencyOperators = {append: 'beforeEnd', prepend: 'afterBegin', before: 'beforeBegin', after: 'afterEnd'};

  for (key in adjacencyOperators)
    $.fn[key] = (function(operator) {
      return function(html){
        return this.each(function(){
          this['insertAdjacent' + (html instanceof Element ? 'Element' : 'HTML')](operator, html);
        });
      };
    })(adjacencyOperators[key]);

  Z.prototype = $.fn;

  return $;
})();

'$' in window || (window.$ = Zepto);

/* assets.js */

(function($){
  var cache = [], timeout;

  $.fn.remove = function(){
    return this.each(function(element){
      if(element.tagName == 'IMG'){
        cache.push(element);
        element.src = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';
        if (timeout) clearTimeout(timeout);
        timeout = setTimeout(function(){ cache = [] }, 60000);
      }
      element.parentNode.removeChild(element);
    });
  }
})(Zepto);

/* event.js */

(function($){
  var $$ = $.qsa, handlers = {}, _zid = 1;
  function zid(element) {
    return element._zid || (element._zid = _zid++);
  }
  function findHandlers(element, event, fn, selector) {
    event = parse(event);
    if (event.ns) var matcher = matcherFor(event.ns);
    return (handlers[zid(element)] || []).filter(function(handler) {
      return handler
        && (!event.e  || handler.e == event.e)
        && (!event.ns || matcher.test(handler.ns))
        && (!fn       || handler.fn == fn)
        && (!selector || handler.sel == selector);
    });
  }
  function parse(event) {
    var parts = ('' + event).split('.');
    return {e: parts[0], ns: parts.slice(1).sort().join(' ')};
  }
  function matcherFor(ns) {
    return new RegExp('(?:^| )' + ns.replace(' ', ' .* ?') + '(?: |$)');
  }

  function add(element, events, fn, selector, delegate){
    var id = zid(element), set = (handlers[id] || (handlers[id] = []));
    events.split(/\s/).forEach(function(event){
      var handler = $.extend(parse(event), {fn: fn, sel: selector, del: delegate, i: set.length});
      set.push(handler);
      element.addEventListener(handler.e, delegate || fn, false);
    });
  }
  function remove(element, events, fn, selector){
    var id = zid(element);
    (events || '').split(/\s/).forEach(function(event){
      findHandlers(element, event, fn, selector).forEach(function(handler){
        delete handlers[id][handler.i];
        element.removeEventListener(handler.e, handler.del || handler.fn, false);
      });
    });
  }

  $.event = {
    add: function(element, events, fn){
      add(element, events, fn);
    },
    remove: function(element, events, fn){
      remove(element, events, fn);
    }
  };

  $.fn.bind = function(event, callback){
    return this.each(function(){
      add(this, event, callback);
    });
  };
  $.fn.unbind = function(event, callback){
    return this.each(function(){
      remove(this, event, callback);
    });
  };

  var eventMethods = ['preventDefault', 'stopImmediatePropagation', 'stopPropagation'];
  function createProxy(event) {
    var proxy = $.extend({originalEvent: event}, event);
    eventMethods.forEach(function(key) {
      proxy[key] = function() {return event[key].apply(event, arguments)};
    });
    return proxy;
  }

  $.fn.delegate = function(selector, event, callback){
    return this.each(function(i, element){
      add(element, event, callback, selector, function(e){
        var target = e.target, nodes = $$(element, selector);
        while (target && nodes.indexOf(target) < 0) target = target.parentNode;
        if (target && !(target === element) && !(target === document)) {
          callback.call(target, $.extend(createProxy(e), {
            currentTarget: target, liveFired: element
          }));
        }
      });
    });
  };
  $.fn.undelegate = function(selector, event, callback){
    return this.each(function(){
      remove(this, event, callback, selector);
    });
  }

  $.fn.live = function(event, callback){
    $(document.body).delegate(this.selector, event, callback);
    return this;
  };
  $.fn.die = function(event, callback){
    $(document.body).undelegate(this.selector, event, callback);
    return this;
  };

  $.fn.trigger = function(event){
    return this.each(function(){
      var e = document.createEvent('Events');
      this.dispatchEvent(e, e.initEvent(event, true, false));
    });
  };
})(Zepto);

/* touch.js */

(function($){
  var touch = {}, touchTimeout;

  function parentIfText(node){
    return 'tagName' in node ? node : node.parentNode;
  }

  $(document).ready(function(){
    $(document.body).bind('touchstart', function(e){
      var now = Date.now(), delta = now - (touch.last || now);
      touch.target = parentIfText(e.touches[0].target);
      touchTimeout && clearTimeout(touchTimeout);
      touch.x1 = e.touches[0].pageX;
      if (delta > 0 && delta <= 250) touch.isDoubleTap = true;
      touch.last = now;
    }).bind('touchmove', function(e){
      touch.x2 = e.touches[0].pageX
    }).bind('touchend', function(e){
      if (touch.isDoubleTap) {
        $(touch.target).trigger('doubleTap');
        touch = {};
      } else if (touch.x2 > 0) {
        Math.abs(touch.x1 - touch.x2) > 30 && $(touch.target).trigger('swipe') &&
          $(touch.target).trigger('swipe' + (touch.x1 - touch.x2 > 0 ? 'Left' : 'Right'));
        touch.x1 = touch.x2 = touch.last = 0;
      } else if ('last' in touch) {
        touchTimeout = setTimeout(function(){
          touchTimeout = null;
          $(touch.target).trigger('tap')
          touch = {};
        }, 250);
      }
    }).bind('touchcancel', function(){ touch = {} });
  });

  ['swipe', 'swipeLeft', 'swipeRight', 'doubleTap', 'tap'].forEach(function(m){
    $.fn[m] = function(callback){ return this.bind(m, callback) }
  });
})(Zepto);