(()=>{var t={757:(t,e,n)=>{t.exports=n(666)},169:()=>{Statamic.$store.registerModule(["publish","fontAwesome"],{namespaced:!0,state:{icons:null},getters:{icons:function(t){return t.icons}},actions:{fetchIcons:function(t){var e=t.commit;return Statamic.$request.get("/!/font-awesome/icons").then((function(t){return e("setIcons",Object.values(t.data))})).catch((function(t){console.log(t)}))}},mutations:{setIcons:function(t,e){t.icons=e}}})},666:t=>{var e=function(t){"use strict";var e,n=Object.prototype,r=n.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},i=o.iterator||"@@iterator",s=o.asyncIterator||"@@asyncIterator",c=o.toStringTag||"@@toStringTag";function a(t,e,n){return Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{a({},"")}catch(t){a=function(t,e,n){return t[e]=n}}function l(t,e,n,r){var o=e&&e.prototype instanceof y?e:y,i=Object.create(o.prototype),s=new S(r||[]);return i._invoke=function(t,e,n){var r=f;return function(o,i){if(r===d)throw new Error("Generator is already running");if(r===p){if("throw"===o)throw i;return R()}for(n.method=o,n.arg=i;;){var s=n.delegate;if(s){var c=T(s,n);if(c){if(c===m)continue;return c}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===f)throw r=p,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=d;var a=u(t,e,n);if("normal"===a.type){if(r=n.done?p:h,a.arg===m)continue;return{value:a.arg,done:n.done}}"throw"===a.type&&(r=p,n.method="throw",n.arg=a.arg)}}}(t,n,s),i}function u(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var f="suspendedStart",h="suspendedYield",d="executing",p="completed",m={};function y(){}function g(){}function v(){}var x={};a(x,i,(function(){return this}));var w=Object.getPrototypeOf,b=w&&w(w(O([])));b&&b!==n&&r.call(b,i)&&(x=b);var L=v.prototype=y.prototype=Object.create(x);function _(t){["next","throw","return"].forEach((function(e){a(t,e,(function(t){return this._invoke(e,t)}))}))}function E(t,e){function n(o,i,s,c){var a=u(t[o],t,i);if("throw"!==a.type){var l=a.arg,f=l.value;return f&&"object"==typeof f&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,s,c)}),(function(t){n("throw",t,s,c)})):e.resolve(f).then((function(t){l.value=t,s(l)}),(function(t){return n("throw",t,s,c)}))}c(a.arg)}var o;this._invoke=function(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}}function T(t,n){var r=t.iterator[n.method];if(r===e){if(n.delegate=null,"throw"===n.method){if(t.iterator.return&&(n.method="return",n.arg=e,T(t,n),"throw"===n.method))return m;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return m}var o=u(r,t.iterator,n.arg);if("throw"===o.type)return n.method="throw",n.arg=o.arg,n.delegate=null,m;var i=o.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=e),n.delegate=null,m):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,m)}function A(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function C(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(A,this),this.reset(!0)}function O(t){if(t){var n=t[i];if(n)return n.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,s=function n(){for(;++o<t.length;)if(r.call(t,o))return n.value=t[o],n.done=!1,n;return n.value=e,n.done=!0,n};return s.next=s}}return{next:R}}function R(){return{value:e,done:!0}}return g.prototype=v,a(L,"constructor",v),a(v,"constructor",g),g.displayName=a(v,c,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===g||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,v):(t.__proto__=v,a(t,c,"GeneratorFunction")),t.prototype=Object.create(L),t},t.awrap=function(t){return{__await:t}},_(E.prototype),a(E.prototype,s,(function(){return this})),t.AsyncIterator=E,t.async=function(e,n,r,o,i){void 0===i&&(i=Promise);var s=new E(l(e,n,r,o),i);return t.isGeneratorFunction(n)?s:s.next().then((function(t){return t.done?t.value:s.next()}))},_(L),a(L,c,"Generator"),a(L,i,(function(){return this})),a(L,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){for(;e.length;){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},t.values=O,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(C),!t)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function o(r,o){return c.type="throw",c.arg=t,n.next=r,o&&(n.method="next",n.arg=e),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var s=this.tryEntries[i],c=s.completion;if("root"===s.tryLoc)return o("end");if(s.tryLoc<=this.prev){var a=r.call(s,"catchLoc"),l=r.call(s,"finallyLoc");if(a&&l){if(this.prev<s.catchLoc)return o(s.catchLoc,!0);if(this.prev<s.finallyLoc)return o(s.finallyLoc)}else if(a){if(this.prev<s.catchLoc)return o(s.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<s.finallyLoc)return o(s.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var s=i?i.completion:{};return s.type=t,s.arg=e,i?(this.method="next",this.next=i.finallyLoc,m):this.complete(s)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),m},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),C(n),m}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;C(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,r){return this.delegate={iterator:O(t),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=e),m}},t}(t.exports);try{regeneratorRuntime=e}catch(t){"object"==typeof globalThis?globalThis.regeneratorRuntime=e:Function("r","regeneratorRuntime = r")(e)}}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}n.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return n.d(e,{a:e}),e},n.d=(t,e)=>{for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{"use strict";n(169);var t=n(757),e=n.n(t);function r(t){return t.split("-")[1]}function o(t){return"y"===t?"height":"width"}function i(t){return t.split("-")[0]}function s(t){return["top","bottom"].includes(i(t))?"x":"y"}function c(t,e,n){let{reference:c,floating:a}=t;const l=c.x+c.width/2-a.width/2,u=c.y+c.height/2-a.height/2,f=s(e),h=o(f),d=c[h]/2-a[h]/2,p="x"===f;let m;switch(i(e)){case"top":m={x:l,y:c.y-a.height};break;case"bottom":m={x:l,y:c.y+c.height};break;case"right":m={x:c.x+c.width,y:u};break;case"left":m={x:c.x-a.width,y:u};break;default:m={x:c.x,y:c.y}}switch(r(e)){case"start":m[f]-=d*(n&&p?-1:1);break;case"end":m[f]+=d*(n&&p?-1:1)}return m}const a=async(t,e,n)=>{const{placement:r="bottom",strategy:o="absolute",middleware:i=[],platform:s}=n,a=i.filter(Boolean),l=await(null==s.isRTL?void 0:s.isRTL(e));let u=await s.getElementRects({reference:t,floating:e,strategy:o}),{x:f,y:h}=c(u,r,l),d=r,p={},m=0;for(let n=0;n<a.length;n++){const{name:i,fn:y}=a[n],{x:g,y:v,data:x,reset:w}=await y({x:f,y:h,initialPlacement:r,placement:d,strategy:o,middlewareData:p,rects:u,platform:s,elements:{reference:t,floating:e}});f=null!=g?g:f,h=null!=v?v:h,p={...p,[i]:{...p[i],...x}},w&&m<=50&&(m++,"object"==typeof w&&(w.placement&&(d=w.placement),w.rects&&(u=!0===w.rects?await s.getElementRects({reference:t,floating:e,strategy:o}):w.rects),({x:f,y:h}=c(u,d,l))),n=-1)}return{x:f,y:h,placement:d,strategy:o,middlewareData:p}};function l(t){return{...t,top:t.y,left:t.x,right:t.x+t.width,bottom:t.y+t.height}}Math.min,Math.max;const u=["top","right","bottom","left"];u.reduce(((t,e)=>t.concat(e,e+"-start",e+"-end")),[]);const f=function(t){return void 0===t&&(t=0),{name:"offset",options:t,async fn(e){const{x:n,y:o}=e,c=await async function(t,e){const{placement:n,platform:o,elements:c}=t,a=await(null==o.isRTL?void 0:o.isRTL(c.floating)),l=i(n),u=r(n),f="x"===s(n),h=["left","top"].includes(l)?-1:1,d=a&&f?-1:1,p="function"==typeof e?e(t):e;let{mainAxis:m,crossAxis:y,alignmentAxis:g}="number"==typeof p?{mainAxis:p,crossAxis:0,alignmentAxis:null}:{mainAxis:0,crossAxis:0,alignmentAxis:null,...p};return u&&"number"==typeof g&&(y="end"===u?-1*g:g),f?{x:y*d,y:m*h}:{x:m*h,y:y*d}}(e,t);return{x:n+c.x,y:o+c.y,data:c}}}};function h(t){var e;return(null==(e=t.ownerDocument)?void 0:e.defaultView)||window}function d(t){return h(t).getComputedStyle(t)}function p(t){return t instanceof h(t).Node}function m(t){return p(t)?(t.nodeName||"").toLowerCase():""}let y;function g(){if(y)return y;const t=navigator.userAgentData;return t&&Array.isArray(t.brands)?(y=t.brands.map((t=>t.brand+"/"+t.version)).join(" "),y):navigator.userAgent}function v(t){return t instanceof h(t).HTMLElement}function x(t){return t instanceof h(t).Element}function w(t){return"undefined"!=typeof ShadowRoot&&(t instanceof h(t).ShadowRoot||t instanceof ShadowRoot)}function b(t){const{overflow:e,overflowX:n,overflowY:r,display:o}=d(t);return/auto|scroll|overlay|hidden|clip/.test(e+r+n)&&!["inline","contents"].includes(o)}function L(t){return["table","td","th"].includes(m(t))}function _(t){const e=/firefox/i.test(g()),n=d(t),r=n.backdropFilter||n.WebkitBackdropFilter;return"none"!==n.transform||"none"!==n.perspective||!!r&&"none"!==r||e&&"filter"===n.willChange||e&&!!n.filter&&"none"!==n.filter||["transform","perspective"].some((t=>n.willChange.includes(t)))||["paint","layout","strict","content"].some((t=>{const e=n.contain;return null!=e&&e.includes(t)}))}function E(){return/^((?!chrome|android).)*safari/i.test(g())}function T(t){return["html","body","#document"].includes(m(t))}const A=Math.min,C=Math.max,S=Math.round;function O(t){const e=d(t);let n=parseFloat(e.width),r=parseFloat(e.height);const o=v(t),i=o?t.offsetWidth:n,s=o?t.offsetHeight:r,c=S(n)!==i||S(r)!==s;return c&&(n=i,r=s),{width:n,height:r,fallback:c}}function R(t){return x(t)?t:t.contextElement}const k={x:1,y:1};function j(t){const e=R(t);if(!v(e))return k;const n=e.getBoundingClientRect(),{width:r,height:o,fallback:i}=O(e);let s=(i?S(n.width):n.width)/r,c=(i?S(n.height):n.height)/o;return s&&Number.isFinite(s)||(s=1),c&&Number.isFinite(c)||(c=1),{x:s,y:c}}function N(t,e,n,r){var o,i;void 0===e&&(e=!1),void 0===n&&(n=!1);const s=t.getBoundingClientRect(),c=R(t);let a=k;e&&(r?x(r)&&(a=j(r)):a=j(t));const u=c?h(c):window,f=E()&&n;let d=(s.left+(f&&(null==(o=u.visualViewport)?void 0:o.offsetLeft)||0))/a.x,p=(s.top+(f&&(null==(i=u.visualViewport)?void 0:i.offsetTop)||0))/a.y,m=s.width/a.x,y=s.height/a.y;if(c){const t=h(c),e=r&&x(r)?h(r):r;let n=t.frameElement;for(;n&&r&&e!==t;){const t=j(n),e=n.getBoundingClientRect(),r=getComputedStyle(n);e.x+=(n.clientLeft+parseFloat(r.paddingLeft))*t.x,e.y+=(n.clientTop+parseFloat(r.paddingTop))*t.y,d*=t.x,p*=t.y,m*=t.x,y*=t.y,d+=e.x,p+=e.y,n=h(n).frameElement}}return l({width:m,height:y,x:d,y:p})}function P(t){return((p(t)?t.ownerDocument:t.document)||window.document).documentElement}function F(t){return x(t)?{scrollLeft:t.scrollLeft,scrollTop:t.scrollTop}:{scrollLeft:t.pageXOffset,scrollTop:t.pageYOffset}}function $(t){return N(P(t)).left+F(t).scrollLeft}function I(t){if("html"===m(t))return t;const e=t.assignedSlot||t.parentNode||w(t)&&t.host||P(t);return w(e)?e.host:e}function M(t){const e=I(t);return T(e)?e.ownerDocument.body:v(e)&&b(e)?e:M(e)}function D(t,e){var n;void 0===e&&(e=[]);const r=M(t),o=r===(null==(n=t.ownerDocument)?void 0:n.body),i=h(r);return o?e.concat(i,i.visualViewport||[],b(r)?r:[]):e.concat(r,D(r))}function V(t,e,n){let r;if("viewport"===e)r=function(t,e){const n=h(t),r=P(t),o=n.visualViewport;let i=r.clientWidth,s=r.clientHeight,c=0,a=0;if(o){i=o.width,s=o.height;const t=E();(!t||t&&"fixed"===e)&&(c=o.offsetLeft,a=o.offsetTop)}return{width:i,height:s,x:c,y:a}}(t,n);else if("document"===e)r=function(t){const e=P(t),n=F(t),r=t.ownerDocument.body,o=C(e.scrollWidth,e.clientWidth,r.scrollWidth,r.clientWidth),i=C(e.scrollHeight,e.clientHeight,r.scrollHeight,r.clientHeight);let s=-n.scrollLeft+$(t);const c=-n.scrollTop;return"rtl"===d(r).direction&&(s+=C(e.clientWidth,r.clientWidth)-o),{width:o,height:i,x:s,y:c}}(P(t));else if(x(e))r=function(t,e){const n=N(t,!0,"fixed"===e),r=n.top+t.clientTop,o=n.left+t.clientLeft,i=v(t)?j(t):{x:1,y:1};return{width:t.clientWidth*i.x,height:t.clientHeight*i.y,x:o*i.x,y:r*i.y}}(e,n);else{const n={...e};if(E()){var o,i;const e=h(t);n.x-=(null==(o=e.visualViewport)?void 0:o.offsetLeft)||0,n.y-=(null==(i=e.visualViewport)?void 0:i.offsetTop)||0}r=n}return l(r)}function W(t,e){const n=I(t);return!(n===e||!x(n)||T(n))&&("fixed"===d(n).position||W(n,e))}function B(t,e){return v(t)&&"fixed"!==d(t).position?e?e(t):t.offsetParent:null}function G(t,e){const n=h(t);if(!v(t))return n;let r=B(t,e);for(;r&&L(r)&&"static"===d(r).position;)r=B(r,e);return r&&("html"===m(r)||"body"===m(r)&&"static"===d(r).position&&!_(r))?n:r||function(t){let e=I(t);for(;v(e)&&!T(e);){if(_(e))return e;e=I(e)}return null}(t)||n}function H(t,e,n){const r=v(e),o=P(e),i=N(t,!0,"fixed"===n,e);let s={scrollLeft:0,scrollTop:0};const c={x:0,y:0};if(r||!r&&"fixed"!==n)if(("body"!==m(e)||b(o))&&(s=F(e)),v(e)){const t=N(e,!0);c.x=t.x+e.clientLeft,c.y=t.y+e.clientTop}else o&&(c.x=$(o));return{x:i.left+s.scrollLeft-c.x,y:i.top+s.scrollTop-c.y,width:i.width,height:i.height}}const U={getClippingRect:function(t){let{element:e,boundary:n,rootBoundary:r,strategy:o}=t;const i="clippingAncestors"===n?function(t,e){const n=e.get(t);if(n)return n;let r=D(t).filter((t=>x(t)&&"body"!==m(t))),o=null;const i="fixed"===d(t).position;let s=i?I(t):t;for(;x(s)&&!T(s);){const e=d(s),n=_(s);n||"fixed"!==e.position||(o=null),(i?!n&&!o:!n&&"static"===e.position&&o&&["absolute","fixed"].includes(o.position)||b(s)&&!n&&W(t,s))?r=r.filter((t=>t!==s)):o=e,s=I(s)}return e.set(t,r),r}(e,this._c):[].concat(n),s=[...i,r],c=s[0],a=s.reduce(((t,n)=>{const r=V(e,n,o);return t.top=C(r.top,t.top),t.right=A(r.right,t.right),t.bottom=A(r.bottom,t.bottom),t.left=C(r.left,t.left),t}),V(e,c,o));return{width:a.right-a.left,height:a.bottom-a.top,x:a.left,y:a.top}},convertOffsetParentRelativeRectToViewportRelativeRect:function(t){let{rect:e,offsetParent:n,strategy:r}=t;const o=v(n),i=P(n);if(n===i)return e;let s={scrollLeft:0,scrollTop:0},c={x:1,y:1};const a={x:0,y:0};if((o||!o&&"fixed"!==r)&&(("body"!==m(n)||b(i))&&(s=F(n)),v(n))){const t=N(n);c=j(n),a.x=t.x+n.clientLeft,a.y=t.y+n.clientTop}return{width:e.width*c.x,height:e.height*c.y,x:e.x*c.x-s.scrollLeft*c.x+a.x,y:e.y*c.y-s.scrollTop*c.y+a.y}},isElement:x,getDimensions:function(t){return O(t)},getOffsetParent:G,getDocumentElement:P,getScale:j,async getElementRects(t){let{reference:e,floating:n,strategy:r}=t;const o=this.getOffsetParent||G,i=this.getDimensions;return{reference:H(e,await o(n),r),floating:{x:0,y:0,...await i(n)}}},getClientRects:t=>Array.from(t.getClientRects()),isRTL:t=>"rtl"===d(t).direction};function X(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==n)return;var r,o,i=[],s=!0,c=!1;try{for(n=n.call(t);!(s=(r=n.next()).done)&&(i.push(r.value),!e||i.length!==e);s=!0);}catch(t){c=!0,o=t}finally{try{s||null==n.return||n.return()}finally{if(c)throw o}}return i}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return Y(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);"Object"===n&&t.constructor&&(n=t.constructor.name);if("Map"===n||"Set"===n)return Array.from(t);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return Y(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function Y(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}function q(t,e,n,r,o,i,s){try{var c=t[i](s),a=c.value}catch(t){return void n(t)}c.done?e(a):Promise.resolve(a).then(r,o)}function z(t){return function(){var e=this,n=arguments;return new Promise((function(r,o){var i=t.apply(e,n);function s(t){q(i,r,o,s,c,"next",t)}function c(t){q(i,r,o,s,c,"throw",t)}s(void 0)}))}}const J={mixins:[Fieldtype],data:function(){return{observer:new IntersectionObserver(this.infiniteScroll),limit:20,search:""}},mounted:function(){this.meta.script?this.loadFontAwesomeScript():this.loadFontAwesomeCss()},computed:{icons:function(){return this.$store.state.publish.fontAwesome.icons},filtered:function(){var t=this;return this.icons.filter((function(e){return e.label.toLowerCase().includes(t.search.toLowerCase())})).filter((function(e){return t.meta.styles.includes(e.style)}))},paginated:function(){return this.filtered.slice(0,this.limit)},hasNextPage:function(){return this.paginated.length<this.filtered.length},selectedOption:function(){var t=this;return this.icons.find((function(e){return e.class===t.value}))},fontAwesomeIsLoaded:function(){var t=this;return(this.meta.script?Array.from(document.getElementsByTagName("script")).filter((function(e){return e.src===t.meta.script})):Array.from(document.getElementsByTagName("link")).filter((function(e){return e.href===t.meta.css}))).length}},methods:{focus:function(){this.$refs.input.focus()},vueSelectUpdated:function(t){t?this.update(t.class):this.update(null)},onOpen:function(){var t=this;return z(e().mark((function n(){return e().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!t.hasNextPage){e.next=4;break}return e.next=3,t.$nextTick();case 3:t.observer.observe(t.$refs.load);case 4:case"end":return e.stop()}}),n)})))()},onClose:function(){this.observer.disconnect()},infiniteScroll:function(t){var n=this;return z(e().mark((function r(){var o,i,s,c,a,l;return e().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(o=X(t,1),i=o[0],s=i.isIntersecting,c=i.target,!s){e.next=8;break}return a=c.offsetParent,l=c.offsetParent.scrollTop,n.limit+=20,e.next=7,n.$nextTick();case 7:a.scrollTop=l;case 8:case"end":return e.stop()}}),r)})))()},positionOptions:function(t,e,n){var r=n.width;t.style.width=r,((t,e,n)=>{const r=new Map,o={platform:U,...n},i={...o.platform,_c:r};return a(t,e,{...o,platform:i})})(e.$refs.toggle,t,{placement:"bottom",middleware:[f({mainAxis:0,crossAxis:-1})]}).then((function(e){var n=e.x,r=e.y;Object.assign(t.style,{left:"".concat(Math.round(n),"px"),top:"".concat(Math.round(r),"px")})}))},loadFontAwesomeScript:function(){if(!this.fontAwesomeIsLoaded){var t=document.createElement("script");t.setAttribute("src",this.meta.script),document.head.appendChild(t)}},loadFontAwesomeCss:function(){if(!this.fontAwesomeIsLoaded){var t=document.createElement("link");t.setAttribute("rel","stylesheet"),t.setAttribute("href",this.meta.css),document.head.appendChild(t)}}}};var K=function(t,e,n,r,o,i,s,c){var a,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=n,l._compiled=!0),r&&(l.functional=!0),i&&(l._scopeId="data-v-"+i),s?(a=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},l._ssrRegister=a):o&&(a=c?function(){o.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:o),a)if(l.functional){l._injectStyles=a;var u=l.render;l.render=function(t,e){return a.call(e),u(t,e)}}else{var f=l.beforeCreate;l.beforeCreate=f?[].concat(f,a):[a]}return{exports:t,options:l}}(J,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return t.icons?n("div",{staticClass:"flex icon-fieldtype-wrapper"},[n("v-select",{ref:"input",staticClass:"w-full",attrs:{"append-to-body":"","calculate-position":t.positionOptions,clearable:"",name:t.name,disabled:t.config.disabled||t.isReadOnly,options:t.paginated,placeholder:t.config.placeholder||"Search ...",searchable:!0,multiple:!1,"close-on-select":!0,value:t.selectedOption},on:{open:t.onOpen,close:t.onClose,input:t.vueSelectUpdated,search:function(e){return t.search=e},"search:focus":function(e){return t.$emit("focus")},"search:blur":function(e){return t.$emit("blur")}},scopedSlots:t._u([{key:"option",fn:function(e){return[n("div",{staticClass:"flex items-center"},[n("i",{staticClass:"flex items-center w-5 h-5",class:e.class}),t._v(" "),n("span",{staticClass:"ml-4 text-xs truncate"},[t._v(t._s(e.label))])])]}},{key:"selected-option",fn:function(e){return[n("div",{staticClass:"flex items-center"},[n("i",{staticClass:"flex items-center w-5 h-5",class:e.class}),t._v(" "),n("span",{staticClass:"ml-4 text-xs truncate"},[t._v(t._s(e.label))])])]}}],null,!1,2274991693)},[t._v(" "),t._v(" "),n("template",{slot:"list-footer"},[n("span",{directives:[{name:"show",rawName:"v-show",value:t.hasNextPage,expression:"hasNextPage"}],ref:"load"})])],2)],1):t._e()}),[],!1,null,null,null);const Q=K.exports;Statamic.$components.register("font_awesome-fieldtype",Q),Statamic.booted((function(){Statamic.$store.dispatch("publish/fontAwesome/fetchIcons")}))})()})();