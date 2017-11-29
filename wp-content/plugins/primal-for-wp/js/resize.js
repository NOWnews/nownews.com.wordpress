/**
 * Handles the resizing of all iframes created by our WordPress plugin
 */

(function($) {

  if(!window.PF) PF = {};

  // Public Facing Functions (methods called by other modules)
  PF.Resize = {
    resize: resize
  };

  // **** Static variables

  // **** State variables

  /** Initialization of the module, hooks up to the relevant event bindings. */
  $(function() {
    $(PF).on("contentHeightChanged", adjustRender);
    $(PF).on("resultCount", checkResultCount);
    
    // ensure all the widget sections are hidden by default
    _hideAllPlugins();
  });

  /* ******************* PUBLIC FUNCTIONS ******************* */
  /**
   * Sends a message to Primal.com with the id of the embedded iframe
   * that needs resizing
   *
   * @param {string} iframe_id The id of the iframe to be resized
   */
  function resize(iframe_id) {
    $("#" + iframe_id).on("load", function() {
      var data = { id: iframe_id };
      $(PF).trigger("send", ["registerIframeId", data, this.contentWindow]);
    });
    var data = { width: $("#" + iframe_id).width(), id: iframe_id };
    setLogoLocation(data);
  }

  /**
   * Wrapper method for handling contentSizeChanged event.
   * @param  {object} e The received event
   * @param  {object} eventData The id, height, and width of the iframe
   */
  function adjustRender(e, eventData) {
    // ensure the plugin is visible 
    _showPlugin("#" + eventData.id);
    setHeight(eventData);
    setLogoLocation(eventData);
  }

  /**
   * Sets the height of the iframe with a specified id
   * @param {object} eventData The id and new height for the target iframe
   **/
  function setHeight(eventData) {
    $("#" + eventData.id).height(eventData.height + "px");
  }

  /**
   * Hides the iframe and its header/powered by logo if no content was found
   * @param {object} e The received event
   * @param {object} eventData The id and number of results in the iframe
   */
  function checkResultCount(e, eventData) {
    if(eventData.count === 0) _hidePlugin("#" + eventData.id);
  }

  /**
   * Controls where the 'powered by primal' logo is displayed
   * @param  {object} eventData The id of the iframe
   */
  function setLogoLocation(eventData) {
    if(eventData.width > 390) {
      //Show 'powered by primal' above the iframe
      $("#" + eventData.id).parent().children(".primalHeader").children(".headerLink").show();
      $("#" + eventData.id).parent().children(".primalFooter").children(".footerLink").hide();
    }
    else {
      //Show 'powered by primal' below the iframe
      $("#" + eventData.id).parent().children(".primalHeader").children(".headerLink").hide();
      $("#" + eventData.id).parent().children(".primalFooter").children(".footerLink").show();
    }
  }

  /* ******************* PRIVATE FUNCTIONS ******************* */
  /** Hides the plugin with the given ID. */
  function _hidePlugin(id) {
    var jqWidget = $(id).parents('.primalWidget');
    _getContainer(jqWidget).hide();
  }
  
  /** Hides the plugin with the given ID. */
  function _showPlugin(id) {
    var jqWidget = $(id).parents('.primalWidget');
    _getContainer(jqWidget).show();
  }
  
  /** Hides all the plugins on the page. */
  function _hideAllPlugins() {
    // hide the widgets as well as the one that can appear at the bottom of the post
    $('.primalWidget').each((i, obj) => {
      var jqContainer = _getContainer($(obj));
      jqContainer.hide();
    });
  }
  
  /** Returns the container element for the widget (that should be toggled).
   * 
   * When the plugin appears within the post body it does not have a dedicated container
   * in the same way it does as a widget insert.
   */
  function _getContainer(jqWidget) {
    var jqContainer = jqWidget.parents('.widget');
    if (jqContainer.length > 0) return jqContainer;
    else return jqWidget;
  }
  
})(jQuery);
