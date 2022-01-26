<footer>
    <div class="footer-container container-fluid">
    <div class="footer-row row">
        <div class="footer-col col-md-12 text-center">
            <div class="footer-copyright">
                <p>
                    <strong>
                        &copy; Tüm Hakları Saklıdır | <?= date("Y")?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    </div>

</footer>

<!-- Loading Animation -->

<style>
.loader-wrapper {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgb(67, 144, 56);
  display:flex;
  justify-content: center;
  align-items: center;
}
.loader {
  display: inline-block;
  width: 100px;
  height: 100px;
  position: relative;
  border: 4px solid #fff;
  animation: loader 2s infinite ease;
}
.loader-wrapper > .loader > .loader-second{
  display: inline-block;
  width: 100px;
  height: 100px;
  position: relative;
  border: 4px solid #fff;
  animation: loader-second 2s infinite ease;
}
@keyframes loader {
  0% { transform: rotate(0deg);}
  25% { transform: rotate(180deg);}
  50% { transform: rotate(180deg);}
  75% { transform: rotate(180deg);}
  100% { transform: rotate(360deg);}
}

@keyframes loader-second {
  0% { transform: rotate(0deg);}
  25% { transform: rotate(90deg);}
  50% { transform: rotate(90deg);}
  75% { transform: rotate(90deg);}
  100% { transform: rotate(360deg);}
}

</style>

<div class="loader-wrapper">
      <span class="loader">
        <span class="loader-second">

        </span>
      </span>
</div>

    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeToggle("slow");
        });
    </script>

<!--- Footer End --->

<!----<script src="scripts/productsMessage.js"></script>--->
<script src="assets/scripts/dropdownNavbar.js"></script>
<script src="assets/scripts/backToTop.js"></script>

</body>

</html>

<?php
ob_end_flush();
?>