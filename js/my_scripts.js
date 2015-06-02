/*!
 * PEP v0.3.0 | https://github.com/jquery/PEP
 * Copyright jQuery Foundation and other contributors | http://jquery.org/license
 */
!function(a,b){"object"==typeof exports&&"undefined"!=typeof module?module.exports=b():"function"==typeof define&&define.amd?define(b):a.PointerEventsPolyfill=b()}(this,function(){"use strict";function a(){if(k){var a=new Map;return a.pointers=l,a}this.keys=[],this.values=[]}function b(a,b,c,d){this.addCallback=a.bind(d),this.removeCallback=b.bind(d),this.changedCallback=c.bind(d),x&&(this.observer=new x(this.mutationWatcher.bind(this)))}function c(a,b){b=b||Object.create(null);var c=document.createEvent("Event");c.initEvent(a,b.bubbles||!1,b.cancelable||!1);for(var d,e=2;e<B.length;e++)d=B[e],c[d]=b[d]||C[e];c.buttons=b.buttons||0;var f=0;return f=b.pressure?b.pressure:c.buttons?.5:0,c.x=c.clientX,c.y=c.clientY,c.pointerId=b.pointerId||0,c.width=b.width||0,c.height=b.height||0,c.pressure=f,c.tiltX=b.tiltX||0,c.tiltY=b.tiltY||0,c.pointerType=b.pointerType||"",c.hwTimestamp=b.hwTimestamp||0,c.isPrimary=b.isPrimary||!1,c}function d(a){return"body /shadow-deep/ "+e(a)}function e(a){return'[touch-action="'+a+'"]'}function f(a){return"{ -ms-touch-action: "+a+"; touch-action: "+a+"; touch-action-delay: none; }"}function g(){if(G){E.forEach(function(a){String(a)===a?(F+=e(a)+f(a)+"\n",H&&(F+=d(a)+f(a)+"\n")):(F+=a.selectors.map(e)+f(a.rule)+"\n",H&&(F+=a.selectors.map(d)+f(a.rule)+"\n"))});var a=document.createElement("style");a.textContent=F,document.head.appendChild(a)}}function h(){if(!window.PointerEvent){if(window.PointerEvent=D,window.navigator.msPointerEnabled){var a=window.navigator.msMaxTouchPoints;Object.defineProperty(window.navigator,"maxTouchPoints",{value:a,enumerable:!0}),r.registerSource("ms",da)}else r.registerSource("mouse",P),void 0!==window.ontouchstart&&r.registerSource("touch",_);r.register(document)}}function i(a){if(!r.pointermap.has(a))throw new Error("InvalidPointerId")}function j(){window.Element&&!Element.prototype.setPointerCapture&&Object.defineProperties(Element.prototype,{setPointerCapture:{value:Z},releasePointerCapture:{value:$}})}var k=window.Map&&window.Map.prototype.forEach,l=function(){return this.size};a.prototype={set:function(a,b){var c=this.keys.indexOf(a);c>-1?this.values[c]=b:(this.keys.push(a),this.values.push(b))},has:function(a){return this.keys.indexOf(a)>-1},"delete":function(a){var b=this.keys.indexOf(a);b>-1&&(this.keys.splice(b,1),this.values.splice(b,1))},get:function(a){var b=this.keys.indexOf(a);return this.values[b]},clear:function(){this.keys.length=0,this.values.length=0},forEach:function(a,b){this.values.forEach(function(c,d){a.call(b,c,this.keys[d],this)},this)},pointers:function(){return this.keys.length}};var m=a,n=["bubbles","cancelable","view","detail","screenX","screenY","clientX","clientY","ctrlKey","altKey","shiftKey","metaKey","button","relatedTarget","buttons","pointerId","width","height","pressure","tiltX","tiltY","pointerType","hwTimestamp","isPrimary","type","target","currentTarget","which","pageX","pageY","timeStamp"],o=[!1,!1,null,null,0,0,0,0,!1,!1,!1,!1,0,null,0,0,0,0,0,0,0,"",0,!1,"",null,null,0,0,0,0],p="undefined"!=typeof SVGElementInstance,q={pointermap:new m,eventMap:Object.create(null),captureInfo:Object.create(null),eventSources:Object.create(null),eventSourceList:[],registerSource:function(a,b){var c=b,d=c.events;d&&(d.forEach(function(a){c[a]&&(this.eventMap[a]=c[a].bind(c))},this),this.eventSources[a]=c,this.eventSourceList.push(c))},register:function(a){for(var b,c=this.eventSourceList.length,d=0;c>d&&(b=this.eventSourceList[d]);d++)b.register.call(b,a)},unregister:function(a){for(var b,c=this.eventSourceList.length,d=0;c>d&&(b=this.eventSourceList[d]);d++)b.unregister.call(b,a)},contains:function(a,b){return a.contains(b)},down:function(a){a.bubbles=!0,this.fireEvent("pointerdown",a)},move:function(a){a.bubbles=!0,this.fireEvent("pointermove",a)},up:function(a){a.bubbles=!0,this.fireEvent("pointerup",a)},enter:function(a){a.bubbles=!1,this.fireEvent("pointerenter",a)},leave:function(a){a.bubbles=!1,this.fireEvent("pointerleave",a)},over:function(a){a.bubbles=!0,this.fireEvent("pointerover",a)},out:function(a){a.bubbles=!0,this.fireEvent("pointerout",a)},cancel:function(a){a.bubbles=!0,this.fireEvent("pointercancel",a)},leaveOut:function(a){this.out(a),this.contains(a.target,a.relatedTarget)||this.leave(a)},enterOver:function(a){this.over(a),this.contains(a.target,a.relatedTarget)||this.enter(a)},eventHandler:function(a){if(!a._handledByPE){var b=a.type,c=this.eventMap&&this.eventMap[b];c&&c(a),a._handledByPE=!0}},listen:function(a,b){b.forEach(function(b){this.addEvent(a,b)},this)},unlisten:function(a,b){b.forEach(function(b){this.removeEvent(a,b)},this)},addEvent:function(a,b){a.addEventListener(b,this.boundHandler)},removeEvent:function(a,b){a.removeEventListener(b,this.boundHandler)},makeEvent:function(a,b){this.captureInfo[b.pointerId]&&(b.relatedTarget=null);var c=new PointerEvent(a,b);return b.preventDefault&&(c.preventDefault=b.preventDefault),c._target=c._target||b.target,c},fireEvent:function(a,b){var c=this.makeEvent(a,b);return this.dispatchEvent(c)},cloneEvent:function(a){for(var b,c=Object.create(null),d=0;d<n.length;d++)b=n[d],c[b]=a[b]||o[d],!p||"target"!==b&&"relatedTarget"!==b||c[b]instanceof SVGElementInstance&&(c[b]=c[b].correspondingUseElement);return a.preventDefault&&(c.preventDefault=function(){a.preventDefault()}),c},getTarget:function(a){return this.captureInfo[a.pointerId]||a._target},setCapture:function(a,b){this.captureInfo[a]&&this.releaseCapture(a),this.captureInfo[a]=b;var c=document.createEvent("Event");c.initEvent("gotpointercapture",!0,!1),c.pointerId=a,this.implicitRelease=this.releaseCapture.bind(this,a),document.addEventListener("pointerup",this.implicitRelease),document.addEventListener("pointercancel",this.implicitRelease),c._target=b,this.asyncDispatchEvent(c)},releaseCapture:function(a){var b=this.captureInfo[a];if(b){var c=document.createEvent("Event");c.initEvent("lostpointercapture",!0,!1),c.pointerId=a,this.captureInfo[a]=void 0,document.removeEventListener("pointerup",this.implicitRelease),document.removeEventListener("pointercancel",this.implicitRelease),c._target=b,this.asyncDispatchEvent(c)}},dispatchEvent:function(a){var b=this.getTarget(a);return b?b.dispatchEvent(a):void 0},asyncDispatchEvent:function(a){requestAnimationFrame(this.dispatchEvent.bind(this,a))}};q.boundHandler=q.eventHandler.bind(q);var r=q,s={shadow:function(a){return a?a.shadowRoot||a.webkitShadowRoot:void 0},canTarget:function(a){return a&&Boolean(a.elementFromPoint)},targetingShadow:function(a){var b=this.shadow(a);return this.canTarget(b)?b:void 0},olderShadow:function(a){var b=a.olderShadowRoot;if(!b){var c=a.querySelector("shadow");c&&(b=c.olderShadowRoot)}return b},allShadows:function(a){for(var b=[],c=this.shadow(a);c;)b.push(c),c=this.olderShadow(c);return b},searchRoot:function(a,b,c){if(a){var d,e,f=a.elementFromPoint(b,c);for(e=this.targetingShadow(f);e;){if(d=e.elementFromPoint(b,c)){var g=this.targetingShadow(d);return this.searchRoot(g,b,c)||d}e=this.olderShadow(e)}return f}},owner:function(a){for(var b=a;b.parentNode;)b=b.parentNode;return b.nodeType!=Node.DOCUMENT_NODE&&b.nodeType!=Node.DOCUMENT_FRAGMENT_NODE&&(b=document),b},findTarget:function(a){var b=a.clientX,c=a.clientY,d=this.owner(a.target);return d.elementFromPoint(b,c)||(d=document),this.searchRoot(d,b,c)}},t=Array.prototype.forEach.call.bind(Array.prototype.forEach),u=Array.prototype.map.call.bind(Array.prototype.map),v=Array.prototype.slice.call.bind(Array.prototype.slice),w=Array.prototype.filter.call.bind(Array.prototype.filter),x=window.MutationObserver||window.WebKitMutationObserver,y="[touch-action]",z={subtree:!0,childList:!0,attributes:!0,attributeOldValue:!0,attributeFilter:["touch-action"]};b.prototype={watchSubtree:function(a){s.canTarget(a)&&this.observer.observe(a,z)},enableOnSubtree:function(a){this.watchSubtree(a),a===document&&"complete"!==document.readyState?this.installOnLoad():this.installNewSubtree(a)},installNewSubtree:function(a){t(this.findElements(a),this.addElement,this)},findElements:function(a){return a.querySelectorAll?a.querySelectorAll(y):[]},removeElement:function(a){this.removeCallback(a)},addElement:function(a){this.addCallback(a)},elementChanged:function(a,b){this.changedCallback(a,b)},concatLists:function(a,b){return a.concat(v(b))},installOnLoad:function(){document.addEventListener("readystatechange",function(){"complete"===document.readyState&&this.installNewSubtree(document)}.bind(this))},isElement:function(a){return a.nodeType===Node.ELEMENT_NODE},flattenMutationTree:function(a){var b=u(a,this.findElements,this);return b.push(w(a,this.isElement)),b.reduce(this.concatLists,[])},mutationWatcher:function(a){a.forEach(this.mutationHandler,this)},mutationHandler:function(a){if("childList"===a.type){var b=this.flattenMutationTree(a.addedNodes);b.forEach(this.addElement,this);var c=this.flattenMutationTree(a.removedNodes);c.forEach(this.removeElement,this)}else"attributes"===a.type&&this.elementChanged(a.target,a.oldValue)}},x||(b.prototype.watchSubtree=function(){console.warn("PointerEventsPolyfill: MutationObservers not found, touch-action will not be dynamically detected")});var A=b,B=["bubbles","cancelable","view","detail","screenX","screenY","clientX","clientY","ctrlKey","altKey","shiftKey","metaKey","button","relatedTarget","pageX","pageY"],C=[!1,!1,null,null,0,0,0,0,!1,!1,!1,!1,0,null,0,0],D=c,E=["none","auto","pan-x","pan-y",{rule:"pan-x pan-y",selectors:["pan-x pan-y","pan-y pan-x"]}],F="",G=(document.head,window.PointerEvent||window.MSPointerEvent),H=!window.ShadowDOMPolyfill&&document.head.createShadowRoot,I=r.pointermap,J=25,K=[0,1,4,2],L=!1;try{L=1===new MouseEvent("test",{buttons:1}).buttons}catch(M){}var N,O={POINTER_ID:1,POINTER_TYPE:"mouse",events:["mousedown","mousemove","mouseup","mouseover","mouseout"],register:function(a){r.listen(a,this.events)},unregister:function(a){r.unlisten(a,this.events)},lastTouches:[],isEventSimulatedFromTouch:function(a){for(var b,c=this.lastTouches,d=a.clientX,e=a.clientY,f=0,g=c.length;g>f&&(b=c[f]);f++){var h=Math.abs(d-b.x),i=Math.abs(e-b.y);if(J>=h&&J>=i)return!0}},prepareEvent:function(a){var b=r.cloneEvent(a),c=b.preventDefault;return b.preventDefault=function(){a.preventDefault(),c()},b.pointerId=this.POINTER_ID,b.isPrimary=!0,b.pointerType=this.POINTER_TYPE,L||(b.buttons=K[b.which]||0),b},mousedown:function(a){if(!this.isEventSimulatedFromTouch(a)){var b=I.has(this.POINTER_ID);b&&this.cancel(a);var c=this.prepareEvent(a);I.set(this.POINTER_ID,a),r.down(c)}},mousemove:function(a){if(!this.isEventSimulatedFromTouch(a)){var b=this.prepareEvent(a);r.move(b)}},mouseup:function(a){if(!this.isEventSimulatedFromTouch(a)){var b=I.get(this.POINTER_ID);if(b&&b.button===a.button){var c=this.prepareEvent(a);r.up(c),this.cleanupMouse()}}},mouseover:function(a){if(!this.isEventSimulatedFromTouch(a)){var b=this.prepareEvent(a);r.enterOver(b)}},mouseout:function(a){if(!this.isEventSimulatedFromTouch(a)){var b=this.prepareEvent(a);r.leaveOut(b)}},cancel:function(a){var b=this.prepareEvent(a);r.cancel(b),this.cleanupMouse()},cleanupMouse:function(){I["delete"](this.POINTER_ID)}},P=O,Q=r.captureInfo,R=s.findTarget.bind(s),S=s.allShadows.bind(s),T=r.pointermap,U=(Array.prototype.map.call.bind(Array.prototype.map),2500),V=200,W="touch-action",X=!1,Y={events:["touchstart","touchmove","touchend","touchcancel"],register:function(a){X?r.listen(a,this.events):N.enableOnSubtree(a)},unregister:function(a){X&&r.unlisten(a,this.events)},elementAdded:function(a){var b=a.getAttribute(W),c=this.touchActionToScrollType(b);c&&(a._scrollType=c,r.listen(a,this.events),S(a).forEach(function(a){a._scrollType=c,r.listen(a,this.events)},this))},elementRemoved:function(a){a._scrollType=void 0,r.unlisten(a,this.events),S(a).forEach(function(a){a._scrollType=void 0,r.unlisten(a,this.events)},this)},elementChanged:function(a,b){var c=a.getAttribute(W),d=this.touchActionToScrollType(c),e=this.touchActionToScrollType(b);d&&e?(a._scrollType=d,S(a).forEach(function(a){a._scrollType=d},this)):e?this.elementRemoved(a):d&&this.elementAdded(a)},scrollTypes:{EMITTER:"none",XSCROLLER:"pan-x",YSCROLLER:"pan-y",SCROLLER:/^(?:pan-x pan-y)|(?:pan-y pan-x)|auto$/},touchActionToScrollType:function(a){var b=a,c=this.scrollTypes;return"none"===b?"none":b===c.XSCROLLER?"X":b===c.YSCROLLER?"Y":c.SCROLLER.exec(b)?"XY":void 0},POINTER_TYPE:"touch",firstTouch:null,isPrimaryTouch:function(a){return this.firstTouch===a.identifier},setPrimaryTouch:function(a){(0===T.pointers()||1===T.pointers()&&T.has(1))&&(this.firstTouch=a.identifier,this.firstXY={X:a.clientX,Y:a.clientY},this.scrolling=!1,this.cancelResetClickCount())},removePrimaryPointer:function(a){a.isPrimary&&(this.firstTouch=null,this.firstXY=null,this.resetClickCount())},clickCount:0,resetId:null,resetClickCount:function(){var a=function(){this.clickCount=0,this.resetId=null}.bind(this);this.resetId=setTimeout(a,V)},cancelResetClickCount:function(){this.resetId&&clearTimeout(this.resetId)},typeToButtons:function(a){var b=0;return("touchstart"===a||"touchmove"===a)&&(b=1),b},touchToPointer:function(a){var b=this.currentTouchEvent,c=r.cloneEvent(a),d=c.pointerId=a.identifier+2;c.target=Q[d]||R(c),c.bubbles=!0,c.cancelable=!0,c.detail=this.clickCount,c.button=0,c.buttons=this.typeToButtons(b.type),c.width=a.webkitRadiusX||a.radiusX||0,c.height=a.webkitRadiusY||a.radiusY||0,c.pressure=a.webkitForce||a.force||.5,c.isPrimary=this.isPrimaryTouch(a),c.pointerType=this.POINTER_TYPE;var e=this;return c.preventDefault=function(){e.scrolling=!1,e.firstXY=null,b.preventDefault()},c},processTouches:function(a,b){var c=a.changedTouches;this.currentTouchEvent=a;for(var d,e=0;e<c.length;e++)d=c[e],b.call(this,this.touchToPointer(d))},shouldScroll:function(a){if(this.firstXY){var b,c=a.currentTarget._scrollType;if("none"===c)b=!1;else if("XY"===c)b=!0;else{var d=a.changedTouches[0],e=c,f="Y"===c?"X":"Y",g=Math.abs(d["client"+e]-this.firstXY[e]),h=Math.abs(d["client"+f]-this.firstXY[f]);b=g>=h}return this.firstXY=null,b}},findTouch:function(a,b){for(var c,d=0,e=a.length;e>d&&(c=a[d]);d++)if(c.identifier===b)return!0},vacuumTouches:function(a){var b=a.touches;if(T.pointers()>=b.length){var c=[];T.forEach(function(a,d){if(1!==d&&!this.findTouch(b,d-2)){var e=a.out;c.push(e)}},this),c.forEach(this.cancelOut,this)}},touchstart:function(a){this.vacuumTouches(a),this.setPrimaryTouch(a.changedTouches[0]),this.dedupSynthMouse(a),this.scrolling||(this.clickCount++,this.processTouches(a,this.overDown))},overDown:function(a){T.set(a.pointerId,{target:a.target,out:a,outTarget:a.target});r.over(a),r.enter(a),r.down(a)},touchmove:function(a){this.scrolling||(this.shouldScroll(a)?(this.scrolling=!0,this.touchcancel(a)):(a.preventDefault(),this.processTouches(a,this.moveOverOut)))},moveOverOut:function(a){var b=a,c=T.get(b.pointerId);if(c){var d=c.out,e=c.outTarget;r.move(b),d&&e!==b.target&&(d.relatedTarget=b.target,b.relatedTarget=e,d.target=e,b.target?(r.leaveOut(d),r.enterOver(b)):(b.target=e,b.relatedTarget=null,this.cancelOut(b))),c.out=b,c.outTarget=b.target}},touchend:function(a){this.dedupSynthMouse(a),this.processTouches(a,this.upOut)},upOut:function(a){this.scrolling||(r.up(a),r.out(a),r.leave(a)),this.cleanUpPointer(a)},touchcancel:function(a){this.processTouches(a,this.cancelOut)},cancelOut:function(a){r.cancel(a),r.out(a),r.leave(a),this.cleanUpPointer(a)},cleanUpPointer:function(a){T["delete"](a.pointerId),this.removePrimaryPointer(a)},dedupSynthMouse:function(a){var b=P.lastTouches,c=a.changedTouches[0];if(this.isPrimaryTouch(c)){var d={x:c.clientX,y:c.clientY};b.push(d);var e=function(a,b){var c=a.indexOf(b);c>-1&&a.splice(c,1)}.bind(null,b,d);setTimeout(e,U)}}};X||(N=new A(Y.elementAdded,Y.elementRemoved,Y.elementChanged,Y));var Z,$,_=Y,aa=r.pointermap,ba=window.MSPointerEvent&&"number"==typeof window.MSPointerEvent.MSPOINTER_TYPE_MOUSE,ca={events:["MSPointerDown","MSPointerMove","MSPointerUp","MSPointerOut","MSPointerOver","MSPointerCancel","MSGotPointerCapture","MSLostPointerCapture"],register:function(a){r.listen(a,this.events)},unregister:function(a){r.unlisten(a,this.events)},POINTER_TYPES:["","unavailable","touch","pen","mouse"],prepareEvent:function(a){var b=a;return ba&&(b=r.cloneEvent(a),b.pointerType=this.POINTER_TYPES[a.pointerType]),b},cleanup:function(a){aa["delete"](a)},MSPointerDown:function(a){aa.set(a.pointerId,a);var b=this.prepareEvent(a);r.down(b)},MSPointerMove:function(a){var b=this.prepareEvent(a);r.move(b)},MSPointerUp:function(a){var b=this.prepareEvent(a);r.up(b),this.cleanup(a.pointerId)},MSPointerOut:function(a){var b=this.prepareEvent(a);r.leaveOut(b)},MSPointerOver:function(a){var b=this.prepareEvent(a);r.enterOver(b)},MSPointerCancel:function(a){var b=this.prepareEvent(a);r.cancel(b),this.cleanup(a.pointerId)},MSLostPointerCapture:function(a){var b=r.makeEvent("lostpointercapture",a);r.dispatchEvent(b)},MSGotPointerCapture:function(a){var b=r.makeEvent("gotpointercapture",a);r.dispatchEvent(b)}},da=ca,ea=window.navigator;ea.msPointerEnabled?(Z=function(a){i(a),this.msSetPointerCapture(a)},$=function(a){i(a),this.msReleasePointerCapture(a)}):(Z=function(a){i(a),r.setCapture(a,this)},$=function(a){i(a),r.releaseCapture(a,this)}),g(),h(),j();var fa={dispatcher:r,Installer:A,PointerEvent:D,PointerMap:m,targetFinding:s};return fa});

/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */
;(function($){
	$.fn.superfish = function(op){
		var sf = $.fn.superfish,
			c = sf.c,
			lastClicked,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);
			},
			clicklink = function(e){
				// If this link belongs to a menu item with a submenu, allow the submenu to expand before allowing the link to navigate.
				e.stopPropagation();
				var $li = $(this).parent('li'), o = sf.op;
				if(!$li.hasClass(o.hoverClass) && $li.children('ul').length > 0){
					e.preventDefault();
				}
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };

		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;

			$('li:has(ul)',this).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			});
			if($('.no-touch').length > 0){
				// Normal behavior
				$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out)
					.not('.'+c.bcClass).hideSuperfishUl();
				var $a = $('a',this);
				$a.each(function(i){
					var $li = $a.eq(i).parents('li');
			 		$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			 	});
			} else {
				// Touch behavior using jQuery PEP
				$('li:has(ul)',this).attr('touch-action','none')
					.on('pointerover', over).on('pointerout', out)
					.find('a').on('click', clicklink);
			}

			o.onInit.call(this);
			
		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 2,
		delay		: 800,
		animation	: {opacity:'show'},
		speed		: 'normal',
		autoArrows	: true,
		dropShadows : true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

})(jQuery);

/*!
 * jQuery UI 1.8.9
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI
 */
(function(c,j){function k(a){return!c(a).parents().andSelf().filter(function(){return c.curCSS(this,"visibility")==="hidden"||c.expr.filters.hidden(this)}).length}c.ui=c.ui||{};if(!c.ui.version){c.extend(c.ui,{version:"1.8.9",keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,
NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91}});c.fn.extend({_focus:c.fn.focus,focus:function(a,b){return typeof a==="number"?this.each(function(){var d=this;setTimeout(function(){c(d).focus();b&&b.call(d)},a)}):this._focus.apply(this,arguments)},scrollParent:function(){var a;a=c.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){return/(relative|absolute|fixed)/.test(c.curCSS(this,
"position",1))&&/(auto|scroll)/.test(c.curCSS(this,"overflow",1)+c.curCSS(this,"overflow-y",1)+c.curCSS(this,"overflow-x",1))}).eq(0):this.parents().filter(function(){return/(auto|scroll)/.test(c.curCSS(this,"overflow",1)+c.curCSS(this,"overflow-y",1)+c.curCSS(this,"overflow-x",1))}).eq(0);return/fixed/.test(this.css("position"))||!a.length?c(document):a},zIndex:function(a){if(a!==j)return this.css("zIndex",a);if(this.length){a=c(this[0]);for(var b;a.length&&a[0]!==document;){b=a.css("position");
if(b==="absolute"||b==="relative"||b==="fixed"){b=parseInt(a.css("zIndex"),10);if(!isNaN(b)&&b!==0)return b}a=a.parent()}}return 0},disableSelection:function(){return this.bind((c.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(a){a.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}});c.each(["Width","Height"],function(a,b){function d(f,g,l,m){c.each(e,function(){g-=parseFloat(c.curCSS(f,"padding"+this,true))||0;if(l)g-=parseFloat(c.curCSS(f,
"border"+this+"Width",true))||0;if(m)g-=parseFloat(c.curCSS(f,"margin"+this,true))||0});return g}var e=b==="Width"?["Left","Right"]:["Top","Bottom"],h=b.toLowerCase(),i={innerWidth:c.fn.innerWidth,innerHeight:c.fn.innerHeight,outerWidth:c.fn.outerWidth,outerHeight:c.fn.outerHeight};c.fn["inner"+b]=function(f){if(f===j)return i["inner"+b].call(this);return this.each(function(){c(this).css(h,d(this,f)+"px")})};c.fn["outer"+b]=function(f,g){if(typeof f!=="number")return i["outer"+b].call(this,f);return this.each(function(){c(this).css(h,
d(this,f,true,g)+"px")})}});c.extend(c.expr[":"],{data:function(a,b,d){return!!c.data(a,d[3])},focusable:function(a){var b=a.nodeName.toLowerCase(),d=c.attr(a,"tabindex");if("area"===b){b=a.parentNode;d=b.name;if(!a.href||!d||b.nodeName.toLowerCase()!=="map")return false;a=c("img[usemap=#"+d+"]")[0];return!!a&&k(a)}return(/input|select|textarea|button|object/.test(b)?!a.disabled:"a"==b?a.href||!isNaN(d):!isNaN(d))&&k(a)},tabbable:function(a){var b=c.attr(a,"tabindex");return(isNaN(b)||b>=0)&&c(a).is(":focusable")}});
c(function(){var a=document.body,b=a.appendChild(b=document.createElement("div"));c.extend(b.style,{minHeight:"100px",height:"auto",padding:0,borderWidth:0});c.support.minHeight=b.offsetHeight===100;c.support.selectstart="onselectstart"in b;a.removeChild(b).style.display="none"});c.extend(c.ui,{plugin:{add:function(a,b,d){a=c.ui[a].prototype;for(var e in d){a.plugins[e]=a.plugins[e]||[];a.plugins[e].push([b,d[e]])}},call:function(a,b,d){if((b=a.plugins[b])&&a.element[0].parentNode)for(var e=0;e<b.length;e++)a.options[b[e][0]]&&
b[e][1].apply(a.element,d)}},contains:function(a,b){return document.compareDocumentPosition?a.compareDocumentPosition(b)&16:a!==b&&a.contains(b)},hasScroll:function(a,b){if(c(a).css("overflow")==="hidden")return false;b=b&&b==="left"?"scrollLeft":"scrollTop";var d=false;if(a[b]>0)return true;a[b]=1;d=a[b]>0;a[b]=0;return d},isOverAxis:function(a,b,d){return a>b&&a<b+d},isOver:function(a,b,d,e,h,i){return c.ui.isOverAxis(a,d,h)&&c.ui.isOverAxis(b,e,i)}})}})(jQuery);



/*!
 * jQuery UI Widget 1.8.9
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Widget
 */
(function(b,j){if(b.cleanData){var k=b.cleanData;b.cleanData=function(a){for(var c=0,d;(d=a[c])!=null;c++)b(d).triggerHandler("remove");k(a)}}else{var l=b.fn.remove;b.fn.remove=function(a,c){return this.each(function(){if(!c)if(!a||b.filter(a,[this]).length)b("*",this).add([this]).each(function(){b(this).triggerHandler("remove")});return l.call(b(this),a,c)})}}b.widget=function(a,c,d){var e=a.split(".")[0],f;a=a.split(".")[1];f=e+"-"+a;if(!d){d=c;c=b.Widget}b.expr[":"][f]=function(h){return!!b.data(h,
a)};b[e]=b[e]||{};b[e][a]=function(h,g){arguments.length&&this._createWidget(h,g)};c=new c;c.options=b.extend(true,{},c.options);b[e][a].prototype=b.extend(true,c,{namespace:e,widgetName:a,widgetEventPrefix:b[e][a].prototype.widgetEventPrefix||a,widgetBaseClass:f},d);b.widget.bridge(a,b[e][a])};b.widget.bridge=function(a,c){b.fn[a]=function(d){var e=typeof d==="string",f=Array.prototype.slice.call(arguments,1),h=this;d=!e&&f.length?b.extend.apply(null,[true,d].concat(f)):d;if(e&&d.charAt(0)==="_")return h;
e?this.each(function(){var g=b.data(this,a),i=g&&b.isFunction(g[d])?g[d].apply(g,f):g;if(i!==g&&i!==j){h=i;return false}}):this.each(function(){var g=b.data(this,a);g?g.option(d||{})._init():b.data(this,a,new c(d,this))});return h}};b.Widget=function(a,c){arguments.length&&this._createWidget(a,c)};b.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:false},_createWidget:function(a,c){b.data(c,this.widgetName,this);this.element=b(c);this.options=b.extend(true,{},this.options,
this._getCreateOptions(),a);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()});this._create();this._trigger("create");this._init()},_getCreateOptions:function(){return b.metadata&&b.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName);this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled ui-state-disabled")},
widget:function(){return this.element},option:function(a,c){var d=a;if(arguments.length===0)return b.extend({},this.options);if(typeof a==="string"){if(c===j)return this.options[a];d={};d[a]=c}this._setOptions(d);return this},_setOptions:function(a){var c=this;b.each(a,function(d,e){c._setOption(d,e)});return this},_setOption:function(a,c){this.options[a]=c;if(a==="disabled")this.widget()[c?"addClass":"removeClass"](this.widgetBaseClass+"-disabled ui-state-disabled").attr("aria-disabled",c);return this},
enable:function(){return this._setOption("disabled",false)},disable:function(){return this._setOption("disabled",true)},_trigger:function(a,c,d){var e=this.options[a];c=b.Event(c);c.type=(a===this.widgetEventPrefix?a:this.widgetEventPrefix+a).toLowerCase();d=d||{};if(c.originalEvent){a=b.event.props.length;for(var f;a;){f=b.event.props[--a];c[f]=c.originalEvent[f]}}this.element.trigger(c,d);return!(b.isFunction(e)&&e.call(this.element[0],c,d)===false||c.isDefaultPrevented())}}})(jQuery);


/*
 * jQuery UI Accordion 1.8.11
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Accordion
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */
(function(c){c.widget("ui.accordion",{options:{active:0,animated:"slide",autoHeight:true,clearStyle:false,collapsible:false,event:"click",fillSpace:false,header:"> li > :first-child,> :not(li):even",icons:{header:"ui-icon-triangle-1-e",headerSelected:"ui-icon-triangle-1-s"},navigation:false,navigationFilter:function(){return this.href.toLowerCase()===location.href.toLowerCase()}},_create:function(){var a=this,b=a.options;a.running=0;a.element.addClass("ui-accordion ui-widget ui-helper-reset").children("li").addClass("ui-accordion-li-fix");
a.headers=a.element.find(b.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion",function(){b.disabled||c(this).addClass("ui-state-hover")}).bind("mouseleave.accordion",function(){b.disabled||c(this).removeClass("ui-state-hover")}).bind("focus.accordion",function(){b.disabled||c(this).addClass("ui-state-focus")}).bind("blur.accordion",function(){b.disabled||c(this).removeClass("ui-state-focus")});a.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");
if(b.navigation){var d=a.element.find("a").filter(b.navigationFilter).eq(0);if(d.length){var h=d.closest(".ui-accordion-header");a.active=h.length?h:d.closest(".ui-accordion-content").prev()}}a.active=a._findActive(a.active||b.active).addClass("ui-state-default ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top");a.active.next().addClass("ui-accordion-content-active");a._createIcons();a.resize();a.element.attr("role","tablist");a.headers.attr("role","tab").bind("keydown.accordion",
function(f){return a._keydown(f)}).next().attr("role","tabpanel");a.headers.not(a.active||"").attr({"aria-expanded":"false","aria-selected":"false",tabIndex:-1}).next().hide();a.active.length?a.active.attr({"aria-expanded":"true","aria-selected":"true",tabIndex:0}):a.headers.eq(0).attr("tabIndex",0);c.browser.safari||a.headers.find("a").attr("tabIndex",-1);b.event&&a.headers.bind(b.event.split(" ").join(".accordion ")+".accordion",function(f){a._clickHandler.call(a,f,this);f.preventDefault()})},_createIcons:function(){var a=
this.options;if(a.icons){c("<span></span>").addClass("ui-icon "+a.icons.header).prependTo(this.headers);this.active.children(".ui-icon").toggleClass(a.icons.header).toggleClass(a.icons.headerSelected);this.element.addClass("ui-accordion-icons")}},_destroyIcons:function(){this.headers.children(".ui-icon").remove();this.element.removeClass("ui-accordion-icons")},destroy:function(){var a=this.options;this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-accordion-disabled ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("tabIndex");
this.headers.find("a").removeAttr("tabIndex");this._destroyIcons();var b=this.headers.next().css("display","").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-accordion-disabled ui-state-disabled");if(a.autoHeight||a.fillHeight)b.css("height","");return c.Widget.prototype.destroy.call(this)},_setOption:function(a,b){c.Widget.prototype._setOption.apply(this,arguments);a=="active"&&this.activate(b);if(a=="icons"){this._destroyIcons();
b&&this._createIcons()}if(a=="disabled")this.headers.add(this.headers.next())[b?"addClass":"removeClass"]("ui-accordion-disabled ui-state-disabled")},_keydown:function(a){if(!(this.options.disabled||a.altKey||a.ctrlKey)){var b=c.ui.keyCode,d=this.headers.length,h=this.headers.index(a.target),f=false;switch(a.keyCode){case b.RIGHT:case b.DOWN:f=this.headers[(h+1)%d];break;case b.LEFT:case b.UP:f=this.headers[(h-1+d)%d];break;case b.SPACE:case b.ENTER:this._clickHandler({target:a.target},a.target);
a.preventDefault()}if(f){c(a.target).attr("tabIndex",-1);c(f).attr("tabIndex",0);f.focus();return false}return true}},resize:function(){var a=this.options,b;if(a.fillSpace){if(c.browser.msie){var d=this.element.parent().css("overflow");this.element.parent().css("overflow","hidden")}b=this.element.parent().height();c.browser.msie&&this.element.parent().css("overflow",d);this.headers.each(function(){b-=c(this).outerHeight(true)});this.headers.next().each(function(){c(this).height(Math.max(0,b-c(this).innerHeight()+
c(this).height()))}).css("overflow","auto")}else if(a.autoHeight){b=0;this.headers.next().each(function(){b=Math.max(b,c(this).height("").height())}).height(b)}return this},activate:function(a){this.options.active=a;a=this._findActive(a)[0];this._clickHandler({target:a},a);return this},_findActive:function(a){return a?typeof a==="number"?this.headers.filter(":eq("+a+")"):this.headers.not(this.headers.not(a)):a===false?c([]):this.headers.filter(":eq(0)")},_clickHandler:function(a,b){var d=this.options;
if(!d.disabled)if(a.target){a=c(a.currentTarget||b);b=a[0]===this.active[0];d.active=d.collapsible&&b?false:this.headers.index(a);if(!(this.running||!d.collapsible&&b)){var h=this.active;j=a.next();g=this.active.next();e={options:d,newHeader:b&&d.collapsible?c([]):a,oldHeader:this.active,newContent:b&&d.collapsible?c([]):j,oldContent:g};var f=this.headers.index(this.active[0])>this.headers.index(a[0]);this.active=b?c([]):a;this._toggle(j,g,e,b,f);h.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header);
if(!b){a.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").children(".ui-icon").removeClass(d.icons.header).addClass(d.icons.headerSelected);a.next().addClass("ui-accordion-content-active")}}}else if(d.collapsible){this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header);this.active.next().addClass("ui-accordion-content-active");var g=this.active.next(),
e={options:d,newHeader:c([]),oldHeader:d.active,newContent:c([]),oldContent:g},j=this.active=c([]);this._toggle(j,g,e)}},_toggle:function(a,b,d,h,f){var g=this,e=g.options;g.toShow=a;g.toHide=b;g.data=d;var j=function(){if(g)return g._completed.apply(g,arguments)};g._trigger("changestart",null,g.data);g.running=b.size()===0?a.size():b.size();if(e.animated){d={};d=e.collapsible&&h?{toShow:c([]),toHide:b,complete:j,down:f,autoHeight:e.autoHeight||e.fillSpace}:{toShow:a,toHide:b,complete:j,down:f,autoHeight:e.autoHeight||
e.fillSpace};if(!e.proxied)e.proxied=e.animated;if(!e.proxiedDuration)e.proxiedDuration=e.duration;e.animated=c.isFunction(e.proxied)?e.proxied(d):e.proxied;e.duration=c.isFunction(e.proxiedDuration)?e.proxiedDuration(d):e.proxiedDuration;h=c.ui.accordion.animations;var i=e.duration,k=e.animated;if(k&&!h[k]&&!c.easing[k])k="slide";h[k]||(h[k]=function(l){this.slide(l,{easing:k,duration:i||700})});h[k](d)}else{if(e.collapsible&&h)a.toggle();else{b.hide();a.show()}j(true)}b.prev().attr({"aria-expanded":"false",
"aria-selected":"false",tabIndex:-1}).blur();a.prev().attr({"aria-expanded":"true","aria-selected":"true",tabIndex:0}).focus()},_completed:function(a){this.running=a?0:--this.running;if(!this.running){this.options.clearStyle&&this.toShow.add(this.toHide).css({height:"",overflow:""});this.toHide.removeClass("ui-accordion-content-active");if(this.toHide.length)this.toHide.parent()[0].className=this.toHide.parent()[0].className;this._trigger("change",null,this.data)}}});c.extend(c.ui.accordion,{version:"1.8.11",
animations:{slide:function(a,b){a=c.extend({easing:"swing",duration:300},a,b);if(a.toHide.size())if(a.toShow.size()){var d=a.toShow.css("overflow"),h=0,f={},g={},e;b=a.toShow;e=b[0].style.width;b.width(parseInt(b.parent().width(),10)-parseInt(b.css("paddingLeft"),10)-parseInt(b.css("paddingRight"),10)-(parseInt(b.css("borderLeftWidth"),10)||0)-(parseInt(b.css("borderRightWidth"),10)||0));c.each(["height","paddingTop","paddingBottom"],function(j,i){g[i]="hide";j=(""+c.css(a.toShow[0],i)).match(/^([\d+-.]+)(.*)$/);
f[i]={value:j[1],unit:j[2]||"px"}});a.toShow.css({height:0,overflow:"hidden"}).show();a.toHide.filter(":hidden").each(a.complete).end().filter(":visible").animate(g,{step:function(j,i){if(i.prop=="height")h=i.end-i.start===0?0:(i.now-i.start)/(i.end-i.start);a.toShow[0].style[i.prop]=h*f[i.prop].value+f[i.prop].unit},duration:a.duration,easing:a.easing,complete:function(){a.autoHeight||a.toShow.css("height","");a.toShow.css({width:e,overflow:d});a.complete()}})}else a.toHide.animate({height:"hide",
paddingTop:"hide",paddingBottom:"hide"},a);else a.toShow.animate({height:"show",paddingTop:"show",paddingBottom:"show"},a)},bounceslide:function(a){this.slide(a,{easing:a.down?"easeOutBounce":"swing",duration:a.down?1E3:200})}}})})(jQuery);




/*global jQuery */
/*!	
* Lettering.JS 0.6.1
*
* Copyright 2010, Dave Rupert http://daverupert.com
* Released under the WTFPL license 
* http://sam.zoy.org/wtfpl/
*
* Thanks to Paul Irish - http://paulirish.com - for the feedback.
*
* Date: Mon Sep 20 17:14:00 2010 -0600
*/
(function($){
	function injector(t, splitter, klass, after) {
		var a = t.text().split(splitter), inject = '';
		if (a.length) {
			$(a).each(function(i, item) {
				inject += '<span class="'+klass+(i+1)+'">'+item+'</span>'+after;
			});	
			t.empty().append(inject);
		}
	}
	
	var methods = {
		init : function() {

			return this.each(function() {
				injector($(this), '', 'char', '');
			});

		},

		words : function() {

			return this.each(function() {
				injector($(this), ' ', 'word', ' ');
			});

		},
		
		lines : function() {

			return this.each(function() {
				var r = "eefec303079ad17405c889e092e105b0";
				// Because it's hard to split a <br/> tag consistently across browsers,
				// (*ahem* IE *ahem*), we replaces all <br/> instances with an md5 hash 
				// (of the word "split").  If you're trying to use this plugin on that 
				// md5 hash string, it will fail because you're being ridiculous.
				injector($(this).children("br").replaceWith(r).end(), r, 'line', '');
			});

		}
	};

	$.fn.lettering = function( method ) {
		// Method calling logic
		if ( method && methods[method] ) {
			return methods[ method ].apply( this, [].slice.call( arguments, 1 ));
		} else if ( method === 'letters' || ! method ) {
			return methods.init.apply( this, [].slice.call( arguments, 0 ) ); // always pass an array
		}
		$.error( 'Method ' +  method + ' does not exist on jQuery.lettering' );
		return this;
	};

})(jQuery);

jQuery(document).ready(function($) {

    //set the initial values
    detector = jQuery('.js');
    compareWidth = detector.width();
	smallScreen = '840'; 

	if ($(window).width() < smallScreen) {
		$("body").addClass("one-column");		
	}
	else {
		$("body").addClass("two-column");	
	}
	
	// Toggle for nav menu	
	$('.menu-button').click(function() {
		$('#access, .searchform').slideToggle('medium');			
	});

	// Toggle click for sub-menus on touch screens
	$('.touch .sf-with-ul').click(function() {
		$(this).find('.sub-menu').hide.slideToggle('medium');
	});	
	
	// Credit: http://webdeveloper2.com/2011/06/trigger-javascript-on-css3-media-query-change/
    jQuery(window).resize(function(){
        //compare everytime the window resize event fires
        if(detector.width()!=compareWidth){

            //a change has occurred so update the comparison variable
            compareWidth = detector.width();

			if (compareWidth < smallScreen) {
				$("body").removeClass("two-column").addClass("one-column");
				$('.searchform').hide();
			}
			else {
				$("body").removeClass("one-column").addClass("two-column");
				$('.searchform').show();
			}
			
			if (compareWidth >= smallScreen) {
				$('.searchform').show();
			}
        }

    });	

	if ($(window).width() < 1024) {
		$("body").addClass("mobile");		
	}
	else {
		$("body").addClass("desktop");	
	}

						
	// Top level drop down
		var Revealer = function(relativeParent,absoluteChild,speed) {
        var revealHeight = absoluteChild.height();
        relativeParent.height(revealHeight);
        relativeParent.addClass('hidden');
        this.toggleReveal = function() {
            if (!relativeParent.parent().find(':animated').length) {
                if (relativeParent.css('display')!='none' ) {
                    relativeParent.animate({height:0}, speed, function() {
                        relativeParent.hide();
                    });
                } else {
                    relativeParent.height(0).show().animate({height: revealHeight}, speed);
                }
            }
        };
    };
    
   jQuery('.drop-section').after(jQuery('#contact-form'));
    
    var dropSection = new Revealer(
        jQuery('.drop-section .flow'),               // the relatively positioned container
        jQuery('.drop-section .flow .contents'),     // the absolutely positioned child
        300  // the speed of the animation
    );
    
    jQuery('.ext-link').live('click',function(){
        jQuery('html, body').animate({scrollTop:0}, 'fast');
        dropSection.toggleReveal();
        return false;
    });
    jQuery('.drop-section button[type="reset"]').live('click',function(){
        dropSection.toggleReveal();
        return false;
    });

    jQuery('.drop-section form').live('submit',function(){
        var values = $(this).serialize();
        jQuery.post('',values,function(markup) {
            jQuery('#drop-section .contents').html(markup);
        },'html');
        return false;
    });
	
	// wrap event dates with <strong>
	$(".dtstart").lettering('words');
	
	// jquery ui accordian		
	$( "#sidebar-navigation-widgets" ).accordion({
		autoHeight: false,
		navigation: true,
		collapsible:true
	});


    //  Patch for Mobile Safari's orientation change bug
    //  Based on http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
	var viewport = $('meta[name="viewport"]');
	var nua = navigator.userAgent;
		if ((nua.match(/iPad/i)) || (nua.match(/iPhone/i)) || (nua.match(/iPod/i))) {
			viewport.attr('content', 'width=device-width, minimum-scale=1.0, maximum-scale=1.0');
		$('body')[0].addEventListener("gesturestart", gestureStart, false);
		}	
		function gestureStart() {
			viewport.attr('content', 'width=device-width, minimum-scale=0.25, maximum-scale=1.6');
		}
		
	$.fn.fadeToggle = function(speed, easing, callback) {
       return this.animate({opacity: "toggle"}, speed, easing, callback); 
    };  
    $("a.gigpress-links-toggle").click(function() {
        target = $(this).attr("href").replace(document.location.href,'');
        $(target).fadeToggle("fast");
        $(this).toggleClass("gigpress-link-active");
        return false;
    });
    $("select.gigpress_menu").change(function()
    {
        window.location = $(this).val();
    });

	/*
     * Set up the superfish arguments for non-touch screens
     */
    $( '.menu-header .sf-menu' ).superfish( {
        delay: 200,   // 0.05 second delay on mouseout
        animation:   { opacity: 'show', height: 'show' },   // fade-in and slide-down animation
        speed: 250 // Dropdown our menu fast
    } );

	//background menu animation for non-touch screens
	$('.no-touch .menu-header .sf-menu li').hover(function() {
		$(this).find('ul.sub-menu .menu-item a').stop(true, true)
		.css({
			right: "-15px",
			opacity: "0"
			})
		.animate({
			right: "0",
			opacity: "1",
			easing:"easeInExpo"
		},400);
	}, function() {
		$(this).find('ul.sub-menu .menu-item a').stop(true, true)
		.css({
			right: "0",
			opacity: "1"
			})
		.animate({
			right: "-15px",
			opacity: "0",
			easing:"easeInExpo"
		},300);		
	});		
	
});
	
/*global jQuery */
/*! 
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

$.fn.fitVids = function() {
    var div = document.createElement('div'),
    ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

    div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

    ref.parentNode.insertBefore(div, ref);

    return this.each(function() {
        var selectors = [
        "iframe[src^='http://player.vimeo.com']",
        "iframe[src^='http://www.youtube.com']",
        "iframe[src^='http://www.kickstarter.com']",
        "object",
        "embed"
        ];

        var $allVideos = $(this).find(selectors.join(','));

        $allVideos.each(function() {
            var $this = $(this),
            height = this.tagName == 'OBJECT' ? $this.attr('height') : $this.height(),
            aspectRatio = height / $this.width();
            $this.wrap('<div class="fluid-width-video-wrapper" />').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100) + "%");
            $this.removeAttr('height').removeAttr('width');
        });
    });

}
})( jQuery );
