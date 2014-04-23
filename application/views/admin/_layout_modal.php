<?php $this->load->view('admin/components/page_head'); ?>
  <body style = "background :#ddd;">
    <div class="modal show" role="dialog">
      <?php $this->load->view($sub_view); ?>
      <div class="modal-footer">
        &copy <?php echo $meta_title; ?>
      </div>
    </div>
<?php $this->load->view('admin/components/page_tail'); ?>    
    