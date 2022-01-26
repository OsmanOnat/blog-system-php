<?php
include("header.php");
?>

<div class="modal fade" tabindex="-1" role="dialog" id="ornekModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal Başlığı</h4>
      </div>
      <div class="modal-body">
        <p>Modal İçeriği</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary">Değişiklikleri Kaydet</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!----
Üstteki HTML kodlarını sitenize ekledikten sonra herhangi bir elemana data-toggle=”modal” ve data-target=”#ornekModal” özelliklerini eklemeniz, 
söz konusu elemana tıklandığında modalın görünür olmasını sağlar. Örneğin yukarıdaki modalı açacak bir buton hazırlayalım.
--->

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ornekModal">
  Örnek Modali Aç
</button>



<?php
include("footer.php");
?>