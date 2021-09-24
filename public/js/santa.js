/*! For license information please see santa.js.LICENSE.txt */
(()=>{var t={669:(t,e,n)=>{t.exports=n(609)},448:(t,e,n)=>{"use strict";var o=n(867),r=n(26),i=n(372),s=n(327),a=n(97),c=n(109),u=n(985),l=n(61);t.exports=function(t){return new Promise((function(e,n){var f=t.data,d=t.headers;o.isFormData(f)&&delete d["Content-Type"],(o.isBlob(f)||o.isFile(f))&&f.type&&delete d["Content-Type"];var p=new XMLHttpRequest;if(t.auth){var h=t.auth.username||"",m=unescape(encodeURIComponent(t.auth.password))||"";d.Authorization="Basic "+btoa(h+":"+m)}var v=a(t.baseURL,t.url);if(p.open(t.method.toUpperCase(),s(v,t.params,t.paramsSerializer),!0),p.timeout=t.timeout,p.onreadystatechange=function(){if(p&&4===p.readyState&&(0!==p.status||p.responseURL&&0===p.responseURL.indexOf("file:"))){var o="getAllResponseHeaders"in p?c(p.getAllResponseHeaders()):null,i={data:t.responseType&&"text"!==t.responseType?p.response:p.responseText,status:p.status,statusText:p.statusText,headers:o,config:t,request:p};r(e,n,i),p=null}},p.onabort=function(){p&&(n(l("Request aborted",t,"ECONNABORTED",p)),p=null)},p.onerror=function(){n(l("Network Error",t,null,p)),p=null},p.ontimeout=function(){var e="timeout of "+t.timeout+"ms exceeded";t.timeoutErrorMessage&&(e=t.timeoutErrorMessage),n(l(e,t,"ECONNABORTED",p)),p=null},o.isStandardBrowserEnv()){var y=(t.withCredentials||u(v))&&t.xsrfCookieName?i.read(t.xsrfCookieName):void 0;y&&(d[t.xsrfHeaderName]=y)}if("setRequestHeader"in p&&o.forEach(d,(function(t,e){void 0===f&&"content-type"===e.toLowerCase()?delete d[e]:p.setRequestHeader(e,t)})),o.isUndefined(t.withCredentials)||(p.withCredentials=!!t.withCredentials),t.responseType)try{p.responseType=t.responseType}catch(e){if("json"!==t.responseType)throw e}"function"==typeof t.onDownloadProgress&&p.addEventListener("progress",t.onDownloadProgress),"function"==typeof t.onUploadProgress&&p.upload&&p.upload.addEventListener("progress",t.onUploadProgress),t.cancelToken&&t.cancelToken.promise.then((function(t){p&&(p.abort(),n(t),p=null)})),f||(f=null),p.send(f)}))}},609:(t,e,n)=>{"use strict";var o=n(867),r=n(849),i=n(321),s=n(185);function a(t){var e=new i(t),n=r(i.prototype.request,e);return o.extend(n,i.prototype,e),o.extend(n,e),n}var c=a(n(655));c.Axios=i,c.create=function(t){return a(s(c.defaults,t))},c.Cancel=n(263),c.CancelToken=n(972),c.isCancel=n(502),c.all=function(t){return Promise.all(t)},c.spread=n(713),t.exports=c,t.exports.default=c},263:t=>{"use strict";function e(t){this.message=t}e.prototype.toString=function(){return"Cancel"+(this.message?": "+this.message:"")},e.prototype.__CANCEL__=!0,t.exports=e},972:(t,e,n)=>{"use strict";var o=n(263);function r(t){if("function"!=typeof t)throw new TypeError("executor must be a function.");var e;this.promise=new Promise((function(t){e=t}));var n=this;t((function(t){n.reason||(n.reason=new o(t),e(n.reason))}))}r.prototype.throwIfRequested=function(){if(this.reason)throw this.reason},r.source=function(){var t;return{token:new r((function(e){t=e})),cancel:t}},t.exports=r},502:t=>{"use strict";t.exports=function(t){return!(!t||!t.__CANCEL__)}},321:(t,e,n)=>{"use strict";var o=n(867),r=n(327),i=n(782),s=n(572),a=n(185);function c(t){this.defaults=t,this.interceptors={request:new i,response:new i}}c.prototype.request=function(t){"string"==typeof t?(t=arguments[1]||{}).url=arguments[0]:t=t||{},(t=a(this.defaults,t)).method?t.method=t.method.toLowerCase():this.defaults.method?t.method=this.defaults.method.toLowerCase():t.method="get";var e=[s,void 0],n=Promise.resolve(t);for(this.interceptors.request.forEach((function(t){e.unshift(t.fulfilled,t.rejected)})),this.interceptors.response.forEach((function(t){e.push(t.fulfilled,t.rejected)}));e.length;)n=n.then(e.shift(),e.shift());return n},c.prototype.getUri=function(t){return t=a(this.defaults,t),r(t.url,t.params,t.paramsSerializer).replace(/^\?/,"")},o.forEach(["delete","get","head","options"],(function(t){c.prototype[t]=function(e,n){return this.request(a(n||{},{method:t,url:e}))}})),o.forEach(["post","put","patch"],(function(t){c.prototype[t]=function(e,n,o){return this.request(a(o||{},{method:t,url:e,data:n}))}})),t.exports=c},782:(t,e,n)=>{"use strict";var o=n(867);function r(){this.handlers=[]}r.prototype.use=function(t,e){return this.handlers.push({fulfilled:t,rejected:e}),this.handlers.length-1},r.prototype.eject=function(t){this.handlers[t]&&(this.handlers[t]=null)},r.prototype.forEach=function(t){o.forEach(this.handlers,(function(e){null!==e&&t(e)}))},t.exports=r},97:(t,e,n)=>{"use strict";var o=n(793),r=n(303);t.exports=function(t,e){return t&&!o(e)?r(t,e):e}},61:(t,e,n)=>{"use strict";var o=n(481);t.exports=function(t,e,n,r,i){var s=new Error(t);return o(s,e,n,r,i)}},572:(t,e,n)=>{"use strict";var o=n(867),r=n(527),i=n(502),s=n(655);function a(t){t.cancelToken&&t.cancelToken.throwIfRequested()}t.exports=function(t){return a(t),t.headers=t.headers||{},t.data=r(t.data,t.headers,t.transformRequest),t.headers=o.merge(t.headers.common||{},t.headers[t.method]||{},t.headers),o.forEach(["delete","get","head","post","put","patch","common"],(function(e){delete t.headers[e]})),(t.adapter||s.adapter)(t).then((function(e){return a(t),e.data=r(e.data,e.headers,t.transformResponse),e}),(function(e){return i(e)||(a(t),e&&e.response&&(e.response.data=r(e.response.data,e.response.headers,t.transformResponse))),Promise.reject(e)}))}},481:t=>{"use strict";t.exports=function(t,e,n,o,r){return t.config=e,n&&(t.code=n),t.request=o,t.response=r,t.isAxiosError=!0,t.toJSON=function(){return{message:this.message,name:this.name,description:this.description,number:this.number,fileName:this.fileName,lineNumber:this.lineNumber,columnNumber:this.columnNumber,stack:this.stack,config:this.config,code:this.code}},t}},185:(t,e,n)=>{"use strict";var o=n(867);t.exports=function(t,e){e=e||{};var n={},r=["url","method","data"],i=["headers","auth","proxy","params"],s=["baseURL","transformRequest","transformResponse","paramsSerializer","timeout","timeoutMessage","withCredentials","adapter","responseType","xsrfCookieName","xsrfHeaderName","onUploadProgress","onDownloadProgress","decompress","maxContentLength","maxBodyLength","maxRedirects","transport","httpAgent","httpsAgent","cancelToken","socketPath","responseEncoding"],a=["validateStatus"];function c(t,e){return o.isPlainObject(t)&&o.isPlainObject(e)?o.merge(t,e):o.isPlainObject(e)?o.merge({},e):o.isArray(e)?e.slice():e}function u(r){o.isUndefined(e[r])?o.isUndefined(t[r])||(n[r]=c(void 0,t[r])):n[r]=c(t[r],e[r])}o.forEach(r,(function(t){o.isUndefined(e[t])||(n[t]=c(void 0,e[t]))})),o.forEach(i,u),o.forEach(s,(function(r){o.isUndefined(e[r])?o.isUndefined(t[r])||(n[r]=c(void 0,t[r])):n[r]=c(void 0,e[r])})),o.forEach(a,(function(o){o in e?n[o]=c(t[o],e[o]):o in t&&(n[o]=c(void 0,t[o]))}));var l=r.concat(i).concat(s).concat(a),f=Object.keys(t).concat(Object.keys(e)).filter((function(t){return-1===l.indexOf(t)}));return o.forEach(f,u),n}},26:(t,e,n)=>{"use strict";var o=n(61);t.exports=function(t,e,n){var r=n.config.validateStatus;n.status&&r&&!r(n.status)?e(o("Request failed with status code "+n.status,n.config,null,n.request,n)):t(n)}},527:(t,e,n)=>{"use strict";var o=n(867);t.exports=function(t,e,n){return o.forEach(n,(function(n){t=n(t,e)})),t}},655:(t,e,n)=>{"use strict";var o=n(155),r=n(867),i=n(16),s={"Content-Type":"application/x-www-form-urlencoded"};function a(t,e){!r.isUndefined(t)&&r.isUndefined(t["Content-Type"])&&(t["Content-Type"]=e)}var c,u={adapter:(("undefined"!=typeof XMLHttpRequest||void 0!==o&&"[object process]"===Object.prototype.toString.call(o))&&(c=n(448)),c),transformRequest:[function(t,e){return i(e,"Accept"),i(e,"Content-Type"),r.isFormData(t)||r.isArrayBuffer(t)||r.isBuffer(t)||r.isStream(t)||r.isFile(t)||r.isBlob(t)?t:r.isArrayBufferView(t)?t.buffer:r.isURLSearchParams(t)?(a(e,"application/x-www-form-urlencoded;charset=utf-8"),t.toString()):r.isObject(t)?(a(e,"application/json;charset=utf-8"),JSON.stringify(t)):t}],transformResponse:[function(t){if("string"==typeof t)try{t=JSON.parse(t)}catch(t){}return t}],timeout:0,xsrfCookieName:"XSRF-TOKEN",xsrfHeaderName:"X-XSRF-TOKEN",maxContentLength:-1,maxBodyLength:-1,validateStatus:function(t){return t>=200&&t<300}};u.headers={common:{Accept:"application/json, text/plain, */*"}},r.forEach(["delete","get","head"],(function(t){u.headers[t]={}})),r.forEach(["post","put","patch"],(function(t){u.headers[t]=r.merge(s)})),t.exports=u},849:t=>{"use strict";t.exports=function(t,e){return function(){for(var n=new Array(arguments.length),o=0;o<n.length;o++)n[o]=arguments[o];return t.apply(e,n)}}},327:(t,e,n)=>{"use strict";var o=n(867);function r(t){return encodeURIComponent(t).replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(/%20/g,"+").replace(/%5B/gi,"[").replace(/%5D/gi,"]")}t.exports=function(t,e,n){if(!e)return t;var i;if(n)i=n(e);else if(o.isURLSearchParams(e))i=e.toString();else{var s=[];o.forEach(e,(function(t,e){null!=t&&(o.isArray(t)?e+="[]":t=[t],o.forEach(t,(function(t){o.isDate(t)?t=t.toISOString():o.isObject(t)&&(t=JSON.stringify(t)),s.push(r(e)+"="+r(t))})))})),i=s.join("&")}if(i){var a=t.indexOf("#");-1!==a&&(t=t.slice(0,a)),t+=(-1===t.indexOf("?")?"?":"&")+i}return t}},303:t=>{"use strict";t.exports=function(t,e){return e?t.replace(/\/+$/,"")+"/"+e.replace(/^\/+/,""):t}},372:(t,e,n)=>{"use strict";var o=n(867);t.exports=o.isStandardBrowserEnv()?{write:function(t,e,n,r,i,s){var a=[];a.push(t+"="+encodeURIComponent(e)),o.isNumber(n)&&a.push("expires="+new Date(n).toGMTString()),o.isString(r)&&a.push("path="+r),o.isString(i)&&a.push("domain="+i),!0===s&&a.push("secure"),document.cookie=a.join("; ")},read:function(t){var e=document.cookie.match(new RegExp("(^|;\\s*)("+t+")=([^;]*)"));return e?decodeURIComponent(e[3]):null},remove:function(t){this.write(t,"",Date.now()-864e5)}}:{write:function(){},read:function(){return null},remove:function(){}}},793:t=>{"use strict";t.exports=function(t){return/^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(t)}},985:(t,e,n)=>{"use strict";var o=n(867);t.exports=o.isStandardBrowserEnv()?function(){var t,e=/(msie|trident)/i.test(navigator.userAgent),n=document.createElement("a");function r(t){var o=t;return e&&(n.setAttribute("href",o),o=n.href),n.setAttribute("href",o),{href:n.href,protocol:n.protocol?n.protocol.replace(/:$/,""):"",host:n.host,search:n.search?n.search.replace(/^\?/,""):"",hash:n.hash?n.hash.replace(/^#/,""):"",hostname:n.hostname,port:n.port,pathname:"/"===n.pathname.charAt(0)?n.pathname:"/"+n.pathname}}return t=r(window.location.href),function(e){var n=o.isString(e)?r(e):e;return n.protocol===t.protocol&&n.host===t.host}}():function(){return!0}},16:(t,e,n)=>{"use strict";var o=n(867);t.exports=function(t,e){o.forEach(t,(function(n,o){o!==e&&o.toUpperCase()===e.toUpperCase()&&(t[e]=n,delete t[o])}))}},109:(t,e,n)=>{"use strict";var o=n(867),r=["age","authorization","content-length","content-type","etag","expires","from","host","if-modified-since","if-unmodified-since","last-modified","location","max-forwards","proxy-authorization","referer","retry-after","user-agent"];t.exports=function(t){var e,n,i,s={};return t?(o.forEach(t.split("\n"),(function(t){if(i=t.indexOf(":"),e=o.trim(t.substr(0,i)).toLowerCase(),n=o.trim(t.substr(i+1)),e){if(s[e]&&r.indexOf(e)>=0)return;s[e]="set-cookie"===e?(s[e]?s[e]:[]).concat([n]):s[e]?s[e]+", "+n:n}})),s):s}},713:t=>{"use strict";t.exports=function(t){return function(e){return t.apply(null,e)}}},867:(t,e,n)=>{"use strict";var o=n(849),r=Object.prototype.toString;function i(t){return"[object Array]"===r.call(t)}function s(t){return void 0===t}function a(t){return null!==t&&"object"==typeof t}function c(t){if("[object Object]"!==r.call(t))return!1;var e=Object.getPrototypeOf(t);return null===e||e===Object.prototype}function u(t){return"[object Function]"===r.call(t)}function l(t,e){if(null!=t)if("object"!=typeof t&&(t=[t]),i(t))for(var n=0,o=t.length;n<o;n++)e.call(null,t[n],n,t);else for(var r in t)Object.prototype.hasOwnProperty.call(t,r)&&e.call(null,t[r],r,t)}t.exports={isArray:i,isArrayBuffer:function(t){return"[object ArrayBuffer]"===r.call(t)},isBuffer:function(t){return null!==t&&!s(t)&&null!==t.constructor&&!s(t.constructor)&&"function"==typeof t.constructor.isBuffer&&t.constructor.isBuffer(t)},isFormData:function(t){return"undefined"!=typeof FormData&&t instanceof FormData},isArrayBufferView:function(t){return"undefined"!=typeof ArrayBuffer&&ArrayBuffer.isView?ArrayBuffer.isView(t):t&&t.buffer&&t.buffer instanceof ArrayBuffer},isString:function(t){return"string"==typeof t},isNumber:function(t){return"number"==typeof t},isObject:a,isPlainObject:c,isUndefined:s,isDate:function(t){return"[object Date]"===r.call(t)},isFile:function(t){return"[object File]"===r.call(t)},isBlob:function(t){return"[object Blob]"===r.call(t)},isFunction:u,isStream:function(t){return a(t)&&u(t.pipe)},isURLSearchParams:function(t){return"undefined"!=typeof URLSearchParams&&t instanceof URLSearchParams},isStandardBrowserEnv:function(){return("undefined"==typeof navigator||"ReactNative"!==navigator.product&&"NativeScript"!==navigator.product&&"NS"!==navigator.product)&&("undefined"!=typeof window&&"undefined"!=typeof document)},forEach:l,merge:function t(){var e={};function n(n,o){c(e[o])&&c(n)?e[o]=t(e[o],n):c(n)?e[o]=t({},n):i(n)?e[o]=n.slice():e[o]=n}for(var o=0,r=arguments.length;o<r;o++)l(arguments[o],n);return e},extend:function(t,e,n){return l(e,(function(e,r){t[r]=n&&"function"==typeof e?o(e,n):e})),t},trim:function(t){return t.replace(/^\s*/,"").replace(/\s*$/,"")},stripBOM:function(t){return 65279===t.charCodeAt(0)&&(t=t.slice(1)),t}}},992:(t,e,n)=>{"use strict";n.d(e,{Z:()=>i});var o=n(645),r=n.n(o)()((function(t){return t[1]}));r.push([t.id,"/*!\n * Toastify js 1.9.3\n * https://github.com/apvarun/toastify-js\n * @license MIT licensed\n *\n * Copyright (C) 2018 Varun A P\n */.toastify{padding:12px 20px;color:#fff;display:inline-block;box-shadow:0 3px 6px -1px rgba(0,0,0,.12),0 10px 36px -4px rgba(77,96,232,.3);background:linear-gradient(135deg,#73a5ff,#5477f5);position:fixed;opacity:0;transition:all .4s cubic-bezier(.215,.61,.355,1);border-radius:2px;cursor:pointer;text-decoration:none;max-width:calc(50% - 20px);z-index:2147483647}.toastify.on{opacity:1}.toast-close{opacity:.4;padding:0 5px}.toastify-right{right:15px}.toastify-left{left:15px}.toastify-top{top:-150px}.toastify-bottom{bottom:-150px}.toastify-rounded{border-radius:25px}.toastify-avatar{width:1.5em;height:1.5em;margin:-7px 5px;border-radius:2px}.toastify-center{margin-left:auto;margin-right:auto;left:0;right:0;max-width:-webkit-fit-content;max-width:fit-content;max-width:-moz-fit-content}@media only screen and (max-width:360px){.toastify-left,.toastify-right{margin-left:auto;margin-right:auto;left:0;right:0;max-width:-webkit-fit-content;max-width:-moz-fit-content;max-width:fit-content}}",""]);const i=r},645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,o){"string"==typeof t&&(t=[[null,t,""]]);var r={};if(o)for(var i=0;i<this.length;i++){var s=this[i][0];null!=s&&(r[s]=!0)}for(var a=0;a<t.length;a++){var c=[].concat(t[a]);o&&r[c[0]]||(n&&(c[2]?c[2]="".concat(n," and ").concat(c[2]):c[2]=n),e.push(c))}},e}},155:t=>{var e,n,o=t.exports={};function r(){throw new Error("setTimeout has not been defined")}function i(){throw new Error("clearTimeout has not been defined")}function s(t){if(e===setTimeout)return setTimeout(t,0);if((e===r||!e)&&setTimeout)return e=setTimeout,setTimeout(t,0);try{return e(t,0)}catch(n){try{return e.call(null,t,0)}catch(n){return e.call(this,t,0)}}}!function(){try{e="function"==typeof setTimeout?setTimeout:r}catch(t){e=r}try{n="function"==typeof clearTimeout?clearTimeout:i}catch(t){n=i}}();var a,c=[],u=!1,l=-1;function f(){u&&a&&(u=!1,a.length?c=a.concat(c):l=-1,c.length&&d())}function d(){if(!u){var t=s(f);u=!0;for(var e=c.length;e;){for(a=c,c=[];++l<e;)a&&a[l].run();l=-1,e=c.length}a=null,u=!1,function(t){if(n===clearTimeout)return clearTimeout(t);if((n===i||!n)&&clearTimeout)return n=clearTimeout,clearTimeout(t);try{n(t)}catch(e){try{return n.call(null,t)}catch(e){return n.call(this,t)}}}(t)}}function p(t,e){this.fun=t,this.array=e}function h(){}o.nextTick=function(t){var e=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)e[n-1]=arguments[n];c.push(new p(t,e)),1!==c.length||u||s(d)},p.prototype.run=function(){this.fun.apply(null,this.array)},o.title="browser",o.browser=!0,o.env={},o.argv=[],o.version="",o.versions={},o.on=h,o.addListener=h,o.once=h,o.off=h,o.removeListener=h,o.removeAllListeners=h,o.emit=h,o.prependListener=h,o.prependOnceListener=h,o.listeners=function(t){return[]},o.binding=function(t){throw new Error("process.binding is not supported")},o.cwd=function(){return"/"},o.chdir=function(t){throw new Error("process.chdir is not supported")},o.umask=function(){return 0}},379:(t,e,n)=>{"use strict";var o,r=function(){return void 0===o&&(o=Boolean(window&&document&&document.all&&!window.atob)),o},i=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),s=[];function a(t){for(var e=-1,n=0;n<s.length;n++)if(s[n].identifier===t){e=n;break}return e}function c(t,e){for(var n={},o=[],r=0;r<t.length;r++){var i=t[r],c=e.base?i[0]+e.base:i[0],u=n[c]||0,l="".concat(c," ").concat(u);n[c]=u+1;var f=a(l),d={css:i[1],media:i[2],sourceMap:i[3]};-1!==f?(s[f].references++,s[f].updater(d)):s.push({identifier:l,updater:v(d,e),references:1}),o.push(l)}return o}function u(t){var e=document.createElement("style"),o=t.attributes||{};if(void 0===o.nonce){var r=n.nc;r&&(o.nonce=r)}if(Object.keys(o).forEach((function(t){e.setAttribute(t,o[t])})),"function"==typeof t.insert)t.insert(e);else{var s=i(t.insert||"head");if(!s)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");s.appendChild(e)}return e}var l,f=(l=[],function(t,e){return l[t]=e,l.filter(Boolean).join("\n")});function d(t,e,n,o){var r=n?"":o.media?"@media ".concat(o.media," {").concat(o.css,"}"):o.css;if(t.styleSheet)t.styleSheet.cssText=f(e,r);else{var i=document.createTextNode(r),s=t.childNodes;s[e]&&t.removeChild(s[e]),s.length?t.insertBefore(i,s[e]):t.appendChild(i)}}function p(t,e,n){var o=n.css,r=n.media,i=n.sourceMap;if(r?t.setAttribute("media",r):t.removeAttribute("media"),i&&"undefined"!=typeof btoa&&(o+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i))))," */")),t.styleSheet)t.styleSheet.cssText=o;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(o))}}var h=null,m=0;function v(t,e){var n,o,r;if(e.singleton){var i=m++;n=h||(h=u(e)),o=d.bind(null,n,i,!1),r=d.bind(null,n,i,!0)}else n=u(e),o=p.bind(null,n,e),r=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return o(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;o(t=e)}else r()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=r());var n=c(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var o=0;o<n.length;o++){var r=a(n[o]);s[r].references--}for(var i=c(t,e),u=0;u<n.length;u++){var l=a(n[u]);0===s[l].references&&(s[l].updater(),s.splice(l,1))}n=i}}}},588:function(t){var e,n;e=this,n=function(t){var e=function(t){return new e.lib.init(t)};function n(t,e){return e.offset[t]?isNaN(e.offset[t])?e.offset[t]:e.offset[t]+"px":"0px"}function o(t,e){return!(!t||"string"!=typeof e||!(t.className&&t.className.trim().split(/\s+/gi).indexOf(e)>-1))}return e.lib=e.prototype={toastify:"1.9.3",constructor:e,init:function(t){return t||(t={}),this.options={},this.toastElement=null,this.options.text=t.text||"Hi there!",this.options.node=t.node,this.options.duration=0===t.duration?0:t.duration||3e3,this.options.selector=t.selector,this.options.callback=t.callback||function(){},this.options.destination=t.destination,this.options.newWindow=t.newWindow||!1,this.options.close=t.close||!1,this.options.gravity="bottom"===t.gravity?"toastify-bottom":"toastify-top",this.options.positionLeft=t.positionLeft||!1,this.options.position=t.position||"",this.options.backgroundColor=t.backgroundColor,this.options.avatar=t.avatar||"",this.options.className=t.className||"",this.options.stopOnFocus=void 0===t.stopOnFocus||t.stopOnFocus,this.options.onClick=t.onClick,this.options.offset=t.offset||{x:0,y:0},this},buildToast:function(){if(!this.options)throw"Toastify is not initialized";var t=document.createElement("div");if(t.className="toastify on "+this.options.className,this.options.position?t.className+=" toastify-"+this.options.position:!0===this.options.positionLeft?(t.className+=" toastify-left",console.warn("Property `positionLeft` will be depreciated in further versions. Please use `position` instead.")):t.className+=" toastify-right",t.className+=" "+this.options.gravity,this.options.backgroundColor&&(t.style.background=this.options.backgroundColor),this.options.node&&this.options.node.nodeType===Node.ELEMENT_NODE)t.appendChild(this.options.node);else if(t.innerHTML=this.options.text,""!==this.options.avatar){var e=document.createElement("img");e.src=this.options.avatar,e.className="toastify-avatar","left"==this.options.position||!0===this.options.positionLeft?t.appendChild(e):t.insertAdjacentElement("afterbegin",e)}if(!0===this.options.close){var o=document.createElement("span");o.innerHTML="&#10006;",o.className="toast-close",o.addEventListener("click",function(t){t.stopPropagation(),this.removeElement(this.toastElement),window.clearTimeout(this.toastElement.timeOutValue)}.bind(this));var r=window.innerWidth>0?window.innerWidth:screen.width;("left"==this.options.position||!0===this.options.positionLeft)&&r>360?t.insertAdjacentElement("afterbegin",o):t.appendChild(o)}if(this.options.stopOnFocus&&this.options.duration>0){var i=this;t.addEventListener("mouseover",(function(e){window.clearTimeout(t.timeOutValue)})),t.addEventListener("mouseleave",(function(){t.timeOutValue=window.setTimeout((function(){i.removeElement(t)}),i.options.duration)}))}if(void 0!==this.options.destination&&t.addEventListener("click",function(t){t.stopPropagation(),!0===this.options.newWindow?window.open(this.options.destination,"_blank"):window.location=this.options.destination}.bind(this)),"function"==typeof this.options.onClick&&void 0===this.options.destination&&t.addEventListener("click",function(t){t.stopPropagation(),this.options.onClick()}.bind(this)),"object"==typeof this.options.offset){var s=n("x",this.options),a=n("y",this.options),c="left"==this.options.position?s:"-"+s,u="toastify-top"==this.options.gravity?a:"-"+a;t.style.transform="translate("+c+","+u+")"}return t},showToast:function(){var t;if(this.toastElement=this.buildToast(),!(t=void 0===this.options.selector?document.body:document.getElementById(this.options.selector)))throw"Root element is not defined";return t.insertBefore(this.toastElement,t.firstChild),e.reposition(),this.options.duration>0&&(this.toastElement.timeOutValue=window.setTimeout(function(){this.removeElement(this.toastElement)}.bind(this),this.options.duration)),this},hideToast:function(){this.toastElement.timeOutValue&&clearTimeout(this.toastElement.timeOutValue),this.removeElement(this.toastElement)},removeElement:function(t){t.className=t.className.replace(" on",""),window.setTimeout(function(){this.options.node&&this.options.node.parentNode&&this.options.node.parentNode.removeChild(this.options.node),t.parentNode&&t.parentNode.removeChild(t),this.options.callback.call(t),e.reposition()}.bind(this),400)}},e.reposition=function(){for(var t,e={top:15,bottom:15},n={top:15,bottom:15},r={top:15,bottom:15},i=document.getElementsByClassName("toastify"),s=0;s<i.length;s++){t=!0===o(i[s],"toastify-top")?"toastify-top":"toastify-bottom";var a=i[s].offsetHeight;t=t.substr(9,t.length-1),(window.innerWidth>0?window.innerWidth:screen.width)<=360?(i[s].style[t]=r[t]+"px",r[t]+=a+15):!0===o(i[s],"toastify-left")?(i[s].style[t]=e[t]+"px",e[t]+=a+15):(i[s].style[t]=n[t]+"px",n[t]+=a+15)}return this},e.lib.init.prototype=e.lib,e},t.exports?t.exports=n():e.Toastify=n()}},e={};function n(o){var r=e[o];if(void 0!==r)return r.exports;var i=e[o]={id:o,exports:{}};return t[o].call(i.exports,i,i.exports,n),i.exports}n.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return n.d(e,{a:e}),e},n.d=(t,e)=>{for(var o in e)n.o(e,o)&&!n.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:e[o]})},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{"use strict";const t=function(t){t.preventDefault(),document.querySelector(".secret-santa-box").classList.add("flipped")};var e=n(588),o=n.n(e),r=n(379),i=n.n(r),s=n(992),a={insert:"head",singleton:!1};i()(s.Z,a);s.Z.locals;const c=function(t,e,n){if("secretSantaMessage"!=e)if(e)var r=o()({text:'\n            <div class="wrapper">\n                <h1 class="block  text-3xl">'.concat(t,'</h1>\n                <p class="font-bold text-4xl">').concat(e,'</p>\n                <a class="button error-btn bg-dark py-2 px-4 mt-3 mx-auto w-56">click to close</a>\n            </div>'),duration:9e5,gravity:"bottom",position:"center",className:"think-loser-toast",stopOnFocus:!0,onClick:function(){r.removeElement(r.toastElement),window.clearTimeout(r.toastElement.timeOutValue)}}).showToast();else o()({text:t,duration:3e3,gravity:"bottom",position:"right",backgroundColor:"white",className:"think-toast max-w-none md:max-w-toastify-width",stopOnFocus:!0,onClick:function(){}}).showToast();else{console.log("secretSantaMessage");var i=o()({text:'\n                <div class="wrapper font-bold">\n                    '.concat(n,"\n                </div>\n                "),duration:9e5,gravity:"bottom",position:"center",className:"think-loser-toast",stopOnFocus:!0,onClick:function(){i.removeElement(i.toastElement),window.clearTimeout(i.toastElement.timeOutValue)}}).showToast()}};const u=function(t){if(t.preventDefault(),document.querySelectorAll("ol#nice-list li").length<=3)return c("Can't have less than 3 to make the magic happen");t.target.parentNode.remove()};var l=0;const f=function(t){t instanceof Event&&t.preventDefault();var e=++l,n=document.createElement("input");n.setAttribute("name","name[]"),n.setAttribute("type","text"),n.setAttribute("id","person"+e),n.setAttribute("placeholder","Name"),n.classList.add("name","px-3","w-5/12");var o=document.createElement("input");o.setAttribute("name","email[]"),o.setAttribute("type","email"),o.setAttribute("id","person"+e),o.setAttribute("placeholder","email"),o.classList.add("email","px-3","w-5/12");var r=document.createElement("span");r.classList.add("secret-santa-remove"),r.addEventListener("click",u),r.insertAdjacentHTML("beforeend",'\n    <svg xmlns="http://www.w3.org/2000/svg" viewBox=" 0 0 20 22 " class="fill-current w-full h-full pointer-events-none">\n        <path class="a84ca124-37b7-487d-9221-f9b9cccce2dc" d="M 7.67 7.51 V 16.13 A 0.48 0.48 0 0 1 7.19 16.61 H 6.19 A 0.48 0.48 0 0 1 5.71 16.13 V 7.51 A 0.48 0.48 0 0 1 6.23 7 H 7.23 A 0.48 0.48 0 0 1 7.67 7.51 Z M 11.67 7.03 H 10.67 A 0.48 0.48 0 0 0 10.19 7.51 V 16.13 A 0.48 0.48 0 0 0 10.67 16.61 H 11.67 A 0.47 0.47 0 0 0 12.15 16.13 V 7.51 A 0.47 0.47 0 0 0 11.66 7 Z M 16.94 3.19 A 1 1 0 0 1 17.94 4.19 V 4.67 A 0.47 0.47 0 0 1 17.46 5.15 H 16.66 V 18.53 A 1.91 1.91 0 0 1 14.75 20.45 H 3.19 A 1.92 1.92 0 0 1 1.28 18.53 H 1.28 V 5.11 H 0.48 A 0.47 0.47 0 0 1 0 4.63 H 0 V 4.15 A 1 1 0 0 1 1 3.15 H 4 L 5.29 0.93 A 1.9 1.9 0 0 1 6.93 0 H 10.93 A 1.9 1.9 0 0 1 12.6 0.93 L 14 3.19 Z M 6.18 3.19 H 11.74 L 11 2 A 0.24 0.24 0 0 0 10.79 1.89 H 7.07 A 0.25 0.25 0 0 0 6.86 2 Z M 14.7 5.11 H 3.19 V 18.29 A 0.24 0.24 0 0 0 3.43 18.53 H 14.43 A 0.24 0.24 0 0 0 14.67 18.29 Z"/>\n    </svg>\n    ');var i=document.querySelector("ol#nice-list"),s=document.createElement("li");s.classList.add("mb-1","flex","justify-between","flex-row","p-1"),s.appendChild(n),s.appendChild(o),s.appendChild(r),i.appendChild(s)};const d=function(t){t.preventDefault();var e=document.querySelector(".page-1"),n=document.querySelector(".page-2"),o=t.target;o.classList.contains("secret-santa-final")?(e.classList.add("hide"),n.classList.remove("hide")):o.classList.contains("secret-santa-back-to-page-1")&&(n.classList.add("hide"),e.classList.remove("hide"))};var p=n(669),h=n.n(p);const m=function(t){t.preventDefault();var e=t.target,n=e.querySelector(".loader");if(e.classList.contains("disabled"))return!1;e.classList.add("disabled"),n.classList.remove("hidden");var o=document.getElementById("secret-santa-main-form"),r=new FormData(o);h().post("/secret-santa-results",r).then((function(t){console.log("success"),n.classList.add("hidden"),c("none","secretSantaMessage",t.data.success)})).catch((function(t){var o=t.response;console.log("catch error"),e.classList.remove("disabled"),n.classList.add("hidden"),c("none","secretSantaMessage",o.data.error)})).then()};var v=document.querySelector(".secret-santa-next"),y=document.querySelector(".secret-santa-add-more"),g=document.querySelectorAll(".secret-santa-remove"),b=document.querySelector(".secret-santa-final"),w=document.querySelector(".secret-santa-back-to-page-1"),x=document.querySelector(".secret-santa-submit");v.addEventListener("click",t),y.addEventListener("click",f),b.addEventListener("click",d),w.addEventListener("click",d),g.forEach((function(t){return t.addEventListener("click",u)})),x.addEventListener("click",m);for(var E=0;E<3;E++)f();window.addEventListener("DOMContentLoaded",(function(t){var e=0,n=document.querySelectorAll(".background-slideshow img");setInterval((function(){for(var t=0;t<n.length;t++)n[t].style.opacity=0;e=e!=n.length-1?e+1:0,n[e].style.opacity=1}),7e3)}))})()})();