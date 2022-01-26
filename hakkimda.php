<?php
include("header.php");
?>

<style>
  .comment-container>.comment-row {
    border-radius: 5px;
    border: 1px solid lightgray;
  }
  .comment-form-container > .comment-form-row > .comment-form-col > .form-box{
    border-radius: 5px;
    border: 1px solid lightgray;
  }
</style>

<div class="hakkimizda" style="margin-top:5px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h4><strong>Merhaba </strong></h4>
            </div>
            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam minus aperiam qui, exercitationem illum quam delectus quis! Optio, quae! Aliquid repudiandae, quaerat voluptas est labore beatae neque distinctio accusantium! Nam! <br>
              <br>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis reiciendis architecto modi sunt explicabo autem ea, quod sed ut voluptatibus, aspernatur ex cum voluptates doloribus ducimus quas. Commodi, aliquid dolorum?
              <br>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae neque esse nesciunt culpa! Velit officiis nobis magni recusandae, incidunt quia quisquam distinctio voluptate voluptatem, et rerum harum, cum consequatur cupiditate.
              <br>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis reiciendis architecto modi sunt explicabo autem ea, quod sed ut voluptatibus, aspernatur ex cum voluptates doloribus ducimus quas. Commodi, aliquid dolorum?
              <br><br>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis reiciendis architecto modi sunt explicabo autem ea, quod sed ut voluptatibus, aspernatur ex cum voluptates doloribus ducimus quas. Commodi, aliquid dolorum?
              <br><br>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis reiciendis architecto modi sunt explicabo autem ea, quod sed ut voluptatibus, aspernatur ex cum voluptates doloribus ducimus quas. Commodi, aliquid dolorum?
              <br><br>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis reiciendis architecto modi sunt explicabo autem ea, quod sed ut voluptatibus, aspernatur ex cum voluptates doloribus ducimus quas. Commodi, aliquid dolorum?
              <br>
            </p>
            <div class="card-footer" align="center">
              <div class="ui labeled button" tabindex="0">
                <div class="ui red button">
                  <i class="heart icon"></i> Beğeni
                </div>
                <a class="ui basic red left pointing label">
                  1,048
                </a>
              </div>
              <div class="ui labeled button" tabindex="0">
                <div class="ui green button">
                  <i class="comment icon"></i> Yorum
                </div>
                <a class="ui basic green left pointing label">
                  1,048
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>

<div class="comment-form-container container">
  <div class="comment-form-row row">
    <div class="comment-form-col col-md-12">
      <div class="form-box bg-light p-4">
        <h1>Yorum Yap</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-group">
            <label for="name">İsim</label>
            <input class="form-control" id="isim" type="text" name="isim">
          </div>
          <div class="form-group">
            <label for="email">E-Mail</label>
            <input class="form-control" id="email" type="email" name="email">
          </div>
          <div class="form-group">
            <label for="message">Mesajınız</label>
            <textarea class="form-control" id="message" name="mesaj" rows="5"></textarea>
          </div>
          <input class="btn btn-success" type="submit" value="Gönder" />
      </div>
      </form>
    </div>
  </div>
</div>

<br><br>

<div class="comment-container container">
  <div class="comment-row row bg-light p-4">
    <div class="comment-col col-md-12">
      <div class="comment-head">
        <div class="ui comments">
          <div class="comment">
            <a class="avatar">
              <img src="assets/img/comment_avatar.png">
            </a>
            <div class="content">
              <a class="author">Stevie Feliciano</a>
              <div class="metadata">
                <div class="date">2 days ago</div>
                <div class="rating">
                  <i class="star icon"></i>
                  5 Faves
                </div>
              </div>
              <div class="text">
                Hey guys, I hope this example comment is helping you read this documentation.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br><br>

  <div class="comment-row row bg-light p-4">
    <div class="comment-col col-md-12">
      <div class="comment-head">
        <div class="ui comments">
          <div class="comment">
            <a class="avatar">
              <img src="assets/img/comment_avatar.png">
            </a>
            <div class="content">
              <a class="author">Stevie Feliciano</a>
              <div class="metadata">
                <div class="date">2 days ago</div>
                <div class="rating">
                  <i class="star icon"></i>
                  5 Faves
                </div>
              </div>
              <div class="text">
                Hey guys, I hope this example comment is helping you read this documentation.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<br><br><br>




<?php
include("footer.php");
?>