(function(e,t){"use strict";if(typeof define==="function"&&define.amd){define(["jquery"],t)}else if(typeof exports==="object"){module.exports=t(require("jquery"))}else{e.bootbox=t(e.jQuery)}})(this,function e(t,n){"use strict";function o(e){var t=m[i.locale];return t?t[e]:m.en[e]}function u(e,n,r){e.stopPropagation();e.preventDefault();var i=t.isFunction(r)&&r(e)===false;if(!i){n.modal("hide")}}function a(e){var t,n=0;for(t in e){n++}return n}function f(e,n){var r=0;t.each(e,function(e,t){n(e,t,r++)})}function l(e){var n;var r;if(typeof e!=="object"){throw new Error("Please supply an object of options")}if(!e.message){throw new Error("Please specify a message")}e=t.extend({},i,e);if(!e.buttons){e.buttons={}}e.backdrop=e.backdrop?"static":false;n=e.buttons;r=a(n);f(n,function(e,i,s){if(t.isFunction(i)){i=n[e]={callback:i}}if(t.type(i)!=="object"){throw new Error("button with key "+e+" must be an object")}if(!i.label){i.label=e}if(!i.className){if(r<=2&&s===r-1){i.className="btn-primary btn-info"}else{i.className="btn-default"}}});return e}function c(e,t){var n=e.length;var r={};if(n<1||n>2){throw new Error("Invalid argument length")}if(n===2||typeof e[0]==="string"){r[t[0]]=e[0];r[t[1]]=e[1]}else{r=e[0]}return r}function h(e,n,r){return t.extend(true,{},e,c(n,r))}function p(e,t,n,r){var i={className:"bootbox-"+e,buttons:d.apply(null,t)};return v(h(i,r,n),t)}function d(){var e={};for(var t=0,n=arguments.length;t<n;t++){var r=arguments[t];var i=r.toLowerCase();var s=r.toUpperCase();e[i]={label:o(s)}}return e}function v(e,t){var r={};f(t,function(e,t){r[t]=true});f(e.buttons,function(e){if(r[e]===n){throw new Error("button key "+e+" is not allowed (options are "+t.join("\n")+")")}});return e}var r={dialog:"<div class='bootbox modal' tabindex='-1' role='dialog'>"+"<div class='modal-dialog'>"+"<div class='modal-content'>"+"<div class='modal-body'><div class='bootbox-body'></div></div>"+"</div>"+"</div>"+"</div>",header:"<div class='modal-header'>"+"<h4 class='modal-title'></h4>"+"</div>",footer:"<div class='modal-footer'></div>",closeButton:"<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>",form:"<form class='bootbox-form'></form>",inputs:{text:"<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",textarea:"<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",email:"<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",select:"<select class='bootbox-input bootbox-input-select form-control'></select>",checkbox:"<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",date:"<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",time:"<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",number:"<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",password:"<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"}};var i={locale:"hr",backdrop:true,animate:true,className:null,closeButton:true,show:true,container:"body"};var s={};s.alert=function(){var e;e=p("alert",["ok"],["message","callback"],arguments);if(e.callback&&!t.isFunction(e.callback)){throw new Error("alert requires callback property to be a function when provided")}e.buttons.ok.callback=e.onEscape=function(){if(t.isFunction(e.callback)){return e.callback()}return true};return s.dialog(e)};s.confirm=function(){var e;e=p("confirm",["cancel","confirm"],["message","callback"],arguments);e.buttons.cancel.callback=e.onEscape=function(){return e.callback(false)};e.buttons.confirm.callback=function(){return e.callback(true)};if(!t.isFunction(e.callback)){throw new Error("confirm requires a callback")}return s.dialog(e)};s.prompt=function(){var e;var i;var o;var u;var a;var l;var c;u=t(r.form);i={className:"bootbox-prompt",buttons:d("cancel","confirm"),value:"",inputType:"text"};e=v(h(i,arguments,["title","callback"]),["cancel","confirm"]);l=e.show===n?true:e.show;e.message=u;e.buttons.cancel.callback=e.onEscape=function(){return e.callback(null)};e.buttons.confirm.callback=function(){var n;switch(e.inputType){case"text":case"textarea":case"email":case"select":case"date":case"time":case"number":case"password":n=a.val();break;case"checkbox":var r=a.find("input:checked");n=[];f(r,function(e,r){n.push(t(r).val())});break}return e.callback(n)};e.show=false;if(!e.title){throw new Error("prompt requires a title")}if(!t.isFunction(e.callback)){throw new Error("prompt requires a callback")}if(!r.inputs[e.inputType]){throw new Error("invalid prompt type")}a=t(r.inputs[e.inputType]);switch(e.inputType){case"text":case"textarea":case"email":case"date":case"time":case"number":case"password":a.val(e.value);break;case"select":var p={};c=e.inputOptions||[];if(!c.length){throw new Error("prompt with select requires options")}f(c,function(e,r){var i=a;if(r.value===n||r.text===n){throw new Error("given options in wrong format")}if(r.group){if(!p[r.group]){p[r.group]=t("<optgroup/>").attr("label",r.group)}i=p[r.group]}i.append("<option value='"+r.value+"'>"+r.text+"</option>")});f(p,function(e,t){a.append(t)});a.val(e.value);break;case"checkbox":var m=t.isArray(e.value)?e.value:[e.value];c=e.inputOptions||[];if(!c.length){throw new Error("prompt with checkbox requires options")}if(!c[0].value||!c[0].text){throw new Error("given options in wrong format")}a=t("<div/>");f(c,function(n,i){var s=t(r.inputs[e.inputType]);s.find("input").attr("value",i.value);s.find("label").append(i.text);f(m,function(e,t){if(t===i.value){s.find("input").prop("checked",true)}});a.append(s)});break}if(e.placeholder){a.attr("placeholder",e.placeholder)}if(e.pattern){a.attr("pattern",e.pattern)}u.append(a);u.on("submit",function(e){e.preventDefault();e.stopPropagation();o.find(".btn-primary").click()});o=s.dialog(e);o.off("shown.bs.modal");o.on("shown.bs.modal",function(){a.focus()});if(l===true){o.modal("show")}return o};s.dialog=function(e){e=l(e);var n=t(r.dialog);var i=n.find(".modal-dialog");var s=n.find(".modal-body");var o=e.buttons;var a="";var c={onEscape:e.onEscape};f(o,function(e,t){a+="<button data-bb-handler='"+e+"' type='button' class='btn "+t.className+"'>"+t.label+"</button>";c[e]=t.callback});s.find(".bootbox-body").html(e.message);if(e.animate===true){n.addClass("fade")}if(e.className){n.addClass(e.className)}if(e.size==="large"){i.addClass("modal-lg")}if(e.size==="small"){i.addClass("modal-sm")}if(e.title){s.before(r.header)}if(e.closeButton){var h=t(r.closeButton);if(e.title){n.find(".modal-header").prepend(h)}else{h.css("margin-top","-10px").prependTo(s)}}if(e.title){n.find(".modal-title").html(e.title)}if(a.length){s.after(r.footer);n.find(".modal-footer").html(a)}n.on("hidden.bs.modal",function(e){if(e.target===this){n.remove()}});n.on("shown.bs.modal",function(){n.find(".btn-primary:first").focus()});n.on("escape.close.bb",function(e){if(c.onEscape){u(e,n,c.onEscape)}});n.on("click",".modal-footer button",function(e){var r=t(this).data("bb-handler");u(e,n,c[r])});n.on("click",".bootbox-close-button",function(e){u(e,n,c.onEscape)});n.on("keyup",function(e){if(e.which===27){n.trigger("escape.close.bb")}});t(e.container).append(n);n.modal({backdrop:e.backdrop,keyboard:false,show:false});if(e.show){n.modal("show")}return n};s.setDefaults=function(){var e={};if(arguments.length===2){e[arguments[0]]=arguments[1]}else{e=arguments[0]}t.extend(i,e)};s.hideAll=function(){t(".bootbox").modal("hide");return s};var m={br:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Sim"},cs:{OK:"OK",CANCEL:"Zrušit",CONFIRM:"Potvrdit"},da:{OK:"OK",CANCEL:"Annuller",CONFIRM:"Accepter"},de:{OK:"OK",CANCEL:"Abbrechen",CONFIRM:"Akzeptieren"},el:{OK:"Εντάξει",CANCEL:"Ακύρωση",CONFIRM:"Επιβεβαίωση"},en:{OK:"OK",CANCEL:"Cancel",CONFIRM:"OK"},hr:{OK:"Potvrdi",CANCEL:"Odustani",CONFIRM:"Potvrdi"},es:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Aceptar"},et:{OK:"OK",CANCEL:"Katkesta",CONFIRM:"OK"},fi:{OK:"OK",CANCEL:"Peruuta",CONFIRM:"OK"},fr:{OK:"OK",CANCEL:"Annuler",CONFIRM:"D'accord"},he:{OK:"אישור",CANCEL:"ביטול",CONFIRM:"אישור"},id:{OK:"OK",CANCEL:"Batal",CONFIRM:"OK"},it:{OK:"OK",CANCEL:"Annulla",CONFIRM:"Conferma"},ja:{OK:"OK",CANCEL:"キャンセル",CONFIRM:"確認"},lt:{OK:"Gerai",CANCEL:"Atšaukti",CONFIRM:"Patvirtinti"},lv:{OK:"Labi",CANCEL:"Atcelt",CONFIRM:"Apstiprināt"},nl:{OK:"OK",CANCEL:"Annuleren",CONFIRM:"Accepteren"},no:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},pl:{OK:"OK",CANCEL:"Anuluj",CONFIRM:"Potwierdź"},pt:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Confirmar"},ru:{OK:"OK",CANCEL:"Отмена",CONFIRM:"Применить"},sv:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},tr:{OK:"Tamam",CANCEL:"İptal",CONFIRM:"Onayla"},zh_CN:{OK:"OK",CANCEL:"取消",CONFIRM:"确认"},zh_TW:{OK:"OK",CANCEL:"取消",CONFIRM:"確認"}};s.init=function(n){return e(n||t)};return s})