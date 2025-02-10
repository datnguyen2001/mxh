

<style>


    .xam-header .header__box-top {
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        filter: grayscale(100%);
    }
    .xam-header .header__menu .flex-menu .item-menu-expan .child-menu-hover .menu-child,
    .xam-header .header__menu .flex-menu .item-menu {
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        filter: grayscale(100%);
    }

    /* mob */
    .xam-header .header__middle > .container {
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        filter: grayscale(100%);
    }
    .xam-header .header__menu-mb {
        border-top: 1px solid dimgray;
    }
</style>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        function setCssXam() {
            let checkHome = document.getElementById('home-xam');
            let bodyEl = document.body;
            
            let currentTime = new Date();
            var startTime = new Date('2024/07/24 22:00');
            var endTime = new Date('2024/07/26 22:00');

            // trong khoảng startTime - endTime
            if (startTime <= currentTime && currentTime <= endTime) {
                if (checkHome !== null) {
                    bodyEl.classList.add("xam-all");

                    let styleElement = document.createElement('style');

                    styleElement.textContent = `
                        html {
                            -webkit-filter: grayscale(100%);
                            -moz-filter: grayscale(100%);
                            filter: grayscale(100%);
                        }
                    `;
                    document.head.appendChild(styleElement);
                }
                else {
                    bodyEl.classList.add("xam-header");
                }
            }

            // trước ngày startTime
            if (currentTime < startTime) {
                if (checkHome !== null) {
                    bodyEl.classList.add("xam-all");

                    let styleElement = document.createElement('style');

                    styleElement.textContent = `
                        html {
                            -webkit-filter: grayscale(100%);
                            -moz-filter: grayscale(100%);
                            filter: grayscale(100%);
                        }
                    `;
                    document.head.appendChild(styleElement);
                }
                else {
                    bodyEl.classList.add("xam-header");
                }
            }
        }
        setCssXam();
    });
</script>