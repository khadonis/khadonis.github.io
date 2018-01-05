<?php
include "header.php";
?>

<div class="form-result">
    <div style="z-index: 99999999999;position: absolute;" class="form-res-succes" ></div>
</div>
<section id="specs" class="specs wow fadeInUp">
</section>
<div class="cd-modal" style="display: block;visibility: visible;opacity: 1;background-color: #333;pointer-events: all">
    <div class="cd-modal-content">
        <h2 class="modal-title">
            Sadece bir kaç adıma daha ihtiyacım var.
        </h2>
        <h5 class="modal-subtitle">
            Kendinizden ve projenizden bahsettikten sonra size bir kaç gün içerisinde geri dönüş sağlayacağım.
        </h5>
        <form id="contactForm" class="form text-center" method="POST" action="mail.php" >

            <div class="row">
                <div class="sm-10 sm-push-1">
                    <div class="form-line">
                        <input class="form-input" type="text" name="ad" id="ad" placeholder="Ad*">
                            <div class="form-empty-err">Lütfen isminizi giriniz.</div>
                    </div>
                    <div class="form-line">
                        <input class="form-input" type="text" name="email" id="email" placeholder="Email*">
                            <div class="form-empty-err">Lütfen mail adresinizi giriniz.</div>
                            <div class="form-validate-err">Lütfen geçerli bir mail adresi giriniz.</div>
                    </div>
                    <div class="form-line">
                        <input class="form-input" type="tel" name="tel" id="tel" placeholder="Telefon">
                    </div>
                    <div class="form-line">
                        <textarea class="form-txta" name="mesaj" id="mesaj" placeholder="Lütfen projeniz hakkında bilmem gerekenleri anlatın*"></textarea>
                        <div class="form-empty-err">Lütfen projeniz hakkındaki düşüncelerinizi giriniz.</div>
                    </div>
                    <div class="form-line">
                        <a id="submit" role="button" href="javascript:sendMail()" class="btn btn-go btn-submit">Projenizi Gönderin</a>
                    </div>
                    <div class="form-line">
                        <h4 class="form-required">* Zorunlu alanlar</h4>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- cd-modal-content -->
</div>
<script src="dist/js/app.min.js"></script>
<script>
    function sendMail() {
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: $('#contactForm').serialize(),
            success: function(cevap) {
                $('.form-result').show();
                if (cevap == '') {
                    $('.form-res-succes').html('<span>Mesajınız Gönderilmiştir</span>').addClass('form-res-success');
                    setTimeout(function() {
                        $('.form-result').hide(500);
                    }, 5000);
                } else {
                    $('.form-res-succes').html('<span style="color:#ff0000">Bir hata oluştu</span><br /><input  value="Close" type="reset" onClick="kapat()" />');
                }
            }
        });
    }

</script>