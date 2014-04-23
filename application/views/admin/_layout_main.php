<?php $this->load->view('admin/components/page_head'); ?>
  <body>
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="<?php echo site_url('admin/dashboard'); ?>"><?php echo $meta_title; ?></a>
        <ul class="nav">
          <li class="active"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
          <li><?php echo anchor('admin/page', 'Pages'); ?></li>
          <li><?php echo anchor('admin/page/order', 'Order pages'); ?></li>
          <li><?php echo anchor('admin/user', 'Users'); ?></li>
        </ul>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
        <!-- main column-->
        <div class="span9">
                 
             <?php $this->load->view($sub_view); ?>
        
        </div>
        <!-- Side bar !-->
        <div class="span3">
          <section>
            <?php echo mailto('azimsai@gmail.com','<i class="icon-user"></i>azimsai@gmail.com'); ?><br>
            <?php echo anchor('admin/user/logout', '<i class="icon-off"></i>Logout'); ?>
          </section>
        </div>
      </div>
    </div>
<?php $this->load->view('admin/components/page_tail'); ?>    
    