<div class="home__ns-vietlo" id="boxvietlott">
    <div class="box-title">
        Kết quả xổ số tự chọn
        <img src="{{asset('/images/logo-vlott.png')}}"  alt="Vietlott"/>
    </div>
    <div class="box-content">
        <div class="col box1" >
        </div>
        <div class="col box2">
        </div>
    </div>
    <div class="box-bottom">
        <a href="https://vietlott.vn/" target="_blank" rel="nofollow" class="text" title="Xem kết quả Max 3D, 3D PRO, KENO, BINGO 18">Xem kết quả Max 3D, 3D PRO, KENO, BINGO 18</a>
    </div>
</div>
<script>
    (runinit = window.runinit || []).push(function () {
        $.ajax({
            type: 'GET',
            url: pageSettings.sDomain + "/Ajax/GetVietLott.ashx?gameid=3",
            async: false,
            success: function (data) {
                if (data != null) {
                    var jsonData = JSON.parse(data);
                    var stringData = '';
                    for (var i = 0; i < jsonData.length; i++) {
                        var idata = jsonData[i]

                        var arrListNumber = idata['ListNumber'].split("-");
                        var lstNum = '';
                        for (var ii = 0; ii < arrListNumber.length; ii++) {
                            lstNum += `<span class="item">${arrListNumber[ii]}</span>`;
                        }
                        var currEstJackpot = idata['Jackpot'];
                        currEstJackpot = String(currEstJackpot).replace(/(.)(?=(\d{3})+$)/g, '$1.')
                        stringData += `
                        <div class="row">
                            <p class="text">Mega 6/45 kỳ ${idata['DrawId']} - ${idata['DrawDate']}</p>
                        </div>
                        <div class="row">
                            <div class="list-value">
                                ${lstNum}
                            </div>
                        </div>
                        <div class="row">
                            <div class="list-value">
                                <p class="text">
                                    Jackpot: <span class="red">${currEstJackpot}</span> VND
                                </p>
                            </div>
                        </div>
                    `;
                    }
                    $("#boxvietlott .box2").append($(stringData));
                }
            },
            error: function (e) {
                console.log(e.message);
            }
        });




        $.ajax({
            type: 'GET',
            url: pageSettings.sDomain + "/Ajax/GetVietLott.ashx?gameid=4",
            async: false,
            success: function (data) {
                if (data != null) {
                    // console.log("ket qua vietlott", data);
                    var jsonData = JSON.parse(data);
                    // console.log(jsonData);
                    var stringData = '';
                    for (var i = 0; i < jsonData.length; i++) {
                        var idata = jsonData[i]

                        var arrListNumber = idata['ListNumber'].split("-");
                        var lstNum = '';
                        for (var ii = 0; ii < arrListNumber.length; ii++) {
                            lstNum += `<span class="item">${arrListNumber[ii]}</span>`;
                        }

                        var currEstJackpot = idata['Jackpot'];
                        currEstJackpot = String(currEstJackpot).replace(/(.)(?=(\d{3})+$)/g, '$1.')


                        var currEstJackpot2 = idata['EstJackpot2'];
                        currEstJackpot2 = String(currEstJackpot2).replace(/(.)(?=(\d{3})+$)/g, '$1.')
                        stringData += `<div class="row">
                            <p class="text">Power 6/55 kỳ ${idata['DrawId']} - ${idata['DrawDate']}</p>
                        </div>
                        <div class="row">
                            <div class="list-value">
                                ${lstNum}
                            </div>
                        </div>
                        <div class="row">
                            <div class="list-value">
                                <p class="text">
                                    Jackpot 1: <span class="red">${currEstJackpot}</span> VND
                                </p>
                                <p class="text">
                                    Jackpot 2: <span class="red">${currEstJackpot2}</span> VND
                                </p>
                            </div>
                        </div>`;
                    }

                    $("#boxvietlott .box1").append($(stringData));
                }
            },
            error: function (e) {
                console.log(e.message);
            }
        });

        var swiperFocus = new Swiper('.swiper-container.boxvietlottsw', {
            slidesPerView: 'auto',
            speed: 1000,
            centeredSlides: false,
            preventClicks: false,
            preventClicksPropagation: false,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            }
        });
    });
</script>
