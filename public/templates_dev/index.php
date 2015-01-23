<?php include 'header.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
          <h1 class="page-header">Estadísticas</h1>
          <h3>Últimos 4 elementos</h3>

          <div class="row placeholders">

            <?php foreach ($last_four as $key => $element) {?>
              <div class="col-xs-6 col-sm-3 placeholder">
                <?php if($element['media_type']=='image'): ?>
                  <img src="<?php echo $element['media_image']; ?>" class="img-responsive" alt="Generic placeholder thumbnail">
                <?php endif; ?>
                <h4><?php echo $element['username']; ?></h4>
                <span class="text-muted"><?php echo $element['caption_text']; ?></span>
              </div>
            <?php } ?>
          </div>

          <h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
            <div class="messages"></div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id User</th>
                  <th>Username</th>
                  <th>Full Name</th>
                  <th>Media</th>
                  <th>Visible?</th>
                  <th>Ver</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($all_data as $key => $element): ?>
                  <tr>
                    <td><?php echo $element['id'] ?></td>
                    <td><?php echo $element['user_id'] ?></td>
                    <td><?php echo $element['username'] ?></td>
                    <td><?php echo $element['full_name'] ?></td>
                    <?php if($element['media_type']=="image"): ?>
                      <td><img src="<?php echo $element['media_image']; ?>" alt="" width="150"></td>
                    <?php else: ?>
                      <td>
                        <video width="150" controls>
                          <source src="<?php echo $element['media_video']; ?>" type="video/mp4">
                        </video>
                      </td>
                    <?php endif; ?>
                    <td><span><?php echo ($element['visible']==1) ? "Si" : "No" ; ?></span></td>
                    <td>
                      <a class="btn btn-success" href="<?php echo $element['link'] ?>" target="_blank">Ver</a>
                      <a data-id="<?php echo $element['id'] ?>" class="btn btn-default btn-hide <?php echo (($element['visible']==1)) ? 'visible-*-inline-block' : 'hidden' ; ?>" href="#">Ocultar</a>
                      <a data-id="<?php echo $element['id'] ?>" class="btn btn-default btn-show <?php echo (($element['visible']==0)) ? 'visible-*-inline-block' : 'hidden' ; ?>" href="#">Mostrar</a>
                      
                      <a data-id="<?php echo $element['id'] ?>" class="btn btn-danger btn-delete" href="#">Borrar</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
<?php include 'footer.php'; ?>