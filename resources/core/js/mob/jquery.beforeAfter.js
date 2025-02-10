/*
* jQuery beforeAfter plugin
* @author huudaohoang@channelvn.net
* @version 1.0
* @date January 11, 2017
* @copyright (c) 2017 vccorp
* Example1:
 + html:
    <div class="before-after">
        <div class="panel-before"><img class="before-after-img" src="/images/before-img.jpg" alt=""/></div>
        <div class="panel-after"><img class="before-after-img" src="/images/after-img.jpg" alt=""/></div>
        <div class="PhotoCMS_Caption">Images caption</div>
    </div>
 + javascript:
    $(function () {
        $('.before-after').beforeAfter();
    });

* Example2:
 + html:
    <div class="before-after">
        <img class="before-img" src="/images/before-img.jpg" alt=""/>
        <img class="after-img" src="/images/after-img.jpg" alt=""/>
        <div class="PhotoCMS_Caption">Images caption</div>
    </div>
 + javascript:
    $(function () {
        $('.before-after').beforeAfter({
            beforeImgClass: '.before-img',
            afterImgClass: '.after-img',
            onReady: function () {
                console.log("successful");
            }
        });
    });
*/
(function ($, window, document, undefined) {

    var pluginName = 'beforeAfter',
        defaults = {
            beforeImgClass: '.panel-before img',
            afterImgClass: '.panel-after img',
            initPosition: 0,
            animateSpeed: 500,
            allowFullWidth: false,
            onReady: null,
            onResize: null
        };


    var myPlugin = function (element, options) {
        var self = this;
        self.element = element;
        self.settings = $.extend({}, defaults, options);

        self.init();

        return self;
    };

    var imagesLoaded = function (container, callback) {
        var imgCount = $(container).find('img').length;

        if (imgCount > 0) {
            var i = 0;
            $(container).find("img").one("load error", function () {

                // do stuff
                i++;
                if (i == imgCount) {
                     callback();
                }
            }).each(function () {
                if (this.complete){
                    callback();
                }
            });
        } else {
            callback();
        }
    };

    myPlugin.prototype = {
        init: function () {
            var self = this;
            if ( typeof self.isInit != "boolean") {
                imagesLoaded(self.element, function () {
                    self.isInit = true;
                    self._createWrapper();
                });
            }

        },

        _createWrapper: function () {

            var self = this;

            var $element = $(self.element);
            var beforeImg = $element.find(self.settings.beforeImgClass);
            var afterImg = $element.find(self.settings.afterImgClass);
            var parentEl = $element.parent();
            var supportTouch = "ontouchstart" in document.documentElement;
            var supportsOrientationChange = "onorientationchange" in window;
            var wrapperW = $element.width(),
                initPos = self.settings.initPosition,
                margin = 0;
            percent = $element.attr("position-percent");

            if (self.settings.allowFullWidth) {
                wrapperW = $element.outerWidth();
            }

            if (parentEl && (parentEl.attr("id") == "divfirst" || parentEl.attr("id") == "divend")) {
                parentEl = parentEl.parent();
            }

            if (parentEl && wrapperW > parentEl.width()) {
                if (self.settings.allowFullWidth) {
                    margin = (parentEl.outerWidth() - parentEl.width()) / 2;
                    $element.css({ width: parentEl.outerWidth(), "margin-left": "-" + margin + "px" });
                    wrapperW = parentEl.outerWidth();
                }
                else {
                    $element.width(parentEl.width());
                    wrapperW = parentEl.width();
                }
            }

            self.parentEl = parentEl;
            self.wrapperW = wrapperW;


            var imgWidth = $('[data-role="content"]').width();
            var ratio = wrapperW / imgWidth;

            var imgHeight = imgWidth*10/16 * ratio;

            if (percent != undefined && percent != null) {
                initPos = wrapperW * (percent > 0 ? (parseFloat(percent) / 100) : 0);
                //console.log('init position: '+initPos);
            }

            //remove thẻ cũ
            if ($element.find('.panel-before').length > 0) {
                $element.find('.panel-before').remove();
            }
            else {
                beforeImg.remove();
            }

            if ($element.find('.panel-after').length > 0) {
                $element.find('.panel-after').remove();
            }

            else {
                afterImg.remove();
            }

            //create wrapper

                $element.prepend('<div class="before-after-wrapper" style="overflow:hidden;position: relative;padding:0;user-select: none;-webkit-user-select: none;-moz-user-select: none;width:' + wrapperW + 'px;height:' + imgHeight + 'px;"><div class="after" style="background-image:url(' + afterImg.attr("src") + ');background-size:100% 100%;width:100%;height:100%;"></div><div class="before" style="background-image:url(' + beforeImg.attr("src") + ');background-size:' + wrapperW + 'px ' + imgHeight + 'px;width:' + initPos + 'px;height:' + imgHeight + 'px;"></div></div><div class="btn_after_before"><input class="btn_before" type="button"/><input class="btn_after" type="button"/></div>');


            if ($element.find('.btn_after_before').length > 1) {
                $element.find('.btn_after_before')[0].remove();
            }

            if ($element.find('.before-after-wrapper').length > 1) {
                $element.find('.before-after-wrapper')[0].remove();
            }

            //bind events
            $element.find(".btn_before").unbind("click").bind("click", function () {
                self.showFullBeforeImg();
            });

            $element.find(".btn_after").unbind("click").bind("click", function () {
                self.showFullAfterImg();
            });


            if (supportTouch) {
                var g = false;
                $element.find(".before-after-wrapper").unbind("touchmove").bind("touchmove", function (ev) {
                    var x = ev.touches ? ev.touches[0].clientX : ev.originalEvent.touches[0].clientX;
                    if (g) {
                        ev.preventDefault();
                        var w = x - $element.offset().left;
                        if (w >= 0 && w <= self.wrapperW) {
                            $element.find("div.before").width(w);
                        }
                    }
                });

                $element.find(".before-after-wrapper").unbind("touchstart").bind("touchstart", function (ev) {
                    var x = ev.touches ? ev.touches[0].clientX : ev.originalEvent.touches[0].clientX;
                    var w = x - $element.offset().left;
                    var bw = $element.find("div.before").width();
                    if (w > bw - 30 && w < bw + 30) {
                        g = true;
                    }
                });

                $element.find(".before-after-wrapper").unbind("touchend").bind("touchend", function () {
                    g = false;
                });
            }
            // else {
            $element.find(".before-after-wrapper").unbind("mousemove").bind("mousemove", function (ev) {
                var x = ev.clientX;
                var w = x - $element.offset().left;
                if (w >= 0 && w <= self.wrapperW) {
                    $element.find("div.before").width(w);
                }
            });
            // }

            if (supportsOrientationChange) {
                $(window).on("orientationchange", function (ev) {
                    self._handlerResize(ev);
                });
            }
            else {
                $(window).on("resize", function (ev) {
                    self._handlerResize(ev);
                });
            }

            // if (typeof self.settings.onReady == "function") {
            //     self.settings.onReady.call(this);
            // }
        },

        showFullBeforeImg: function () {
            var self = this;
            $(self.element).find("div.before").animate({
                width: 0
            }, self.settings.animateSpeed);
        },

        showFullAfterImg: function () {
            var self = this;
            $(self.element).find("div.before").animate({
                width: $(self.element).find("div.after").width()
            }, self.settings.animateSpeed);
        },

        _handlerResize: function (e) {
            var self = this;
            //console.log("resize");
            if (self.timerResize)
                clearTimeout(self.timerResize);

            self.timerResize = setTimeout(function () {
                var $element = $(self.element);
                var parentW = 0;

                if (self.parentEl) {
                    if (self.settings.allowFullWidth) {
                        parentW = self.parentEl.outerWidth();
                    }
                    else {
                        parentW = self.parentEl.width();
                    }
                }
                else {
                    parentW = $element.width();
                }

                var wrapperW = $element.find(".before-after-wrapper").width();
                var bw = $element.find("div.before").width();
                var ratio = parentW / wrapperW;
                var wrapperH = Math.round($element.find("div.after").height() * ratio);
                var bgSize = '' + parentW + 'px ' + wrapperH + 'px';

                if (parentW != wrapperW) {
                    $element.width(parentW);
                    $element.find("div.before-after-wrapper").css({ width: parentW, height: wrapperH });
                    $element.find("div.before").css({ width: (bw * ratio), height: wrapperH, 'background-size': bgSize });
                    //set state
                    self.wrapperW = parentW;
                }

                if (typeof self.settings.onResize == "function") {
                    self.settings.onResize(e);
                }
            }, 100);

        }
    };

    $.fn[pluginName] = function (options) {

        if ((options === undefined) || (typeof options === 'object')) {
            return this.each(function () {
                var instance = $.data(this, 'plugin_' + pluginName);

                if (!instance || !(instance instanceof myPlugin)) {
                    $.data(this, 'plugin_' + pluginName, new myPlugin(this, options));
                }
                else {
                    instance.init();
                }
            });
        }

        if ((typeof options !== 'string') || (options[0] === '_') || (options === 'init')) {
            return true;
        }
    };

}(jQuery, window, document));

