<script>
    //Chèn ads giữa bài
    (runinit = window.runinit || []).push(function () {
        //Nếu k chạy ads thì return
        if (typeof _chkPrLink != 'undefined' && _chkPrLink)
            return;


        var mutexAds = '<zone id="l2srqb41"></zone>';
        var content = $('[data-role="content"]');
        if (content.length > 0) {
            var childNodes = content[0].childNodes;
            for (i = 0; i < childNodes.length; i++) {
                var childNode = childNodes[i];

                var isPhotoOrVideo = false;
                if (childNode.nodeName.toLowerCase() == 'div') {
                    // kiem tra xem co la anh khong?
                    var type = $(childNode).attr('class') + '';

                    if (type.indexOf('VCSortableInPreviewMode') >= 0) {
                        isPhotoOrVideo = true;
                    }
                }

                try {
                    if ((i >= childNodes.length / 2 - 1) && (i < childNodes.length / 2) && !isPhotoOrVideo) {
                        if (i <= childNodes.length - 3) {
                            childNode.after(htmlToElement(mutexAds));
                            arfAsync.push("l2srqb41");
                        }
                        break;
                    }
                }
                catch (e) { }
            }
        }
    });
    function htmlToElement(html) {
        var template = document.createElement('template');
        template.innerHTML = html;
        return template.content.firstChild;
    }
</script>

