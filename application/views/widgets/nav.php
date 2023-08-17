<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="p-2" alt="Logo" width="50px">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto w-100 d-flex justify-content-end">
      <li class="nav-item <?= ($this->uri->segment(1) === 'leads') ? 'active' : ''; ?>">
        <a class="nav-link  " href="<?php echo base_url('leads'); ?>">Leads</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(1) === 'opportunities') ? 'active' : ''; ?>">
        <a class="nav-link  " href="<?php echo base_url('opportunities'); ?>">Oportunidades</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(1) === 'accounts') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?php echo base_url('accounts'); ?>">Cuentas</a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle " href="#" id="navbardrop" data-toggle="dropdown">
         <?= $this->session->userdata('name'); ?>
        </a>
        <div class="dropdown-menu">
         <a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Salir</a>
        </div>
      </li>
    </ul>
  </div>
</nav>