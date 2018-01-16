(function() {
    tinymce.create('tinymce.plugins.Wptuts', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
         init : function(ed, url) {
            ed.addButton('drog', {
                title : '吸毒標語',
                cmd : 'drog',
                image : url + '/icons/drog.png'
            });
 
            ed.addButton('smoke', {
                title : '吸菸標語',
                cmd : 'smoke',
                image : url + '/icons/smoke.png'
            });

            ed.addButton('suicide', {
                title : '自殺標語',
                cmd : 'suicide',
                image : url + '/icons/suicide.png'
            });

            ed.addButton('wine', {
                title : '飲酒標語',
                cmd : 'wine',
                image : url + '/icons/wine.png'
            });

            ed.addCommand('drog', function() {
                var return_text = '<p>※<a href="https://www.nownews.com/">【 NOWnews 今日新聞 】</a> 提醒您：<br />少一份毒品，多一分健康；吸毒一時，終身危害。<br />※  戒毒諮詢專線：0800-770-885(0800-請請您-幫幫我)<br />※  安心專線：0800-788-995(0800-請幫幫-救救我)<br />※  張老師專線：1980<br />※  生命線專線：1995<br /></p>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
            ed.addCommand('smoke', function() {
                var return_text = '<p>※<a href="https://www.nownews.com/">【 NOWnews 今日新聞 】</a>提醒您  吸菸會導致肺癌、心臟血管疾病，未滿18歲不得吸菸！※</p>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
            ed.addCommand('suicide', function() {
                var return_text = '<p>※<a href="https://www.nownews.com/">【 NOWnews 今日新聞 】</a> 提醒您：<br />自殺不能解決問題，勇敢求救並非弱者，生命一定可以找到出路。<br />透過守門123步驟-1問2應3轉介，你我都可以成為自殺防治守門人。<br />※  安心專線：0800-788-995(0800-請幫幫-救救我)<br />※  張老師專線：1980<br />※  生命線專線：1995<br /></p>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
            ed.addCommand('wine', function() {
                var return_text = '<p>※<a href="https://www.nownews.com/">【 NOWnews 今日新聞 】</a>提醒您  酒後不開車，飲酒過量有礙健康！※</p>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Wptuts Buttons',
                author : 'Lee',
                authorurl : 'http://wp.tutsplus.com/author/leepham',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'wptuts', tinymce.plugins.Wptuts );
})();