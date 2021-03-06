(function (exports) {

  "use strict";

  /* global $ */
  /* global AjaxPost */

  function AbstractListItem(id, template) {
    this.id = id;
    this.template = template;
  }

  AbstractListItem.prototype.init = function (parent) {

    // The element exists we can skip init right here...
    if ($("#" + this.id).length)
      return this;

    var elm = $(this.template).children().first().clone();
    elm.attr("id", this.id);

    this.onInit(elm);

    $(parent).prepend(elm);

    return this;
  };

  AbstractListItem.prototype.setSubject = function (value) {

    $("#" + this.id)
      .find(".msg-list-subject")
      .text(value);

    return this;
  };

  AbstractListItem.prototype.setTeaser = function (value) {

    $("#" + this.id)
      .find(".msg-list-teaser")
      .html(value + "...");

    return this;
  };

  AbstractListItem.prototype.onError = function (msg) {
    alert("Error" + msg);
  };

  // populate the send button..
  AbstractListItem.prototype.sendRequest = function (msg, onSuccess, onProgress) {
    var that = this;

    (new AjaxPost())
      .sendJson(msg)
      .done(onSuccess)
      .progress(onProgress)
      .fail(function (cause) { that.onError(cause); });
  };


  exports.AbstractListItem = AbstractListItem;

})(window);
