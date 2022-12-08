<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-title">Sitemap</h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class=" col-lg-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-heads">
                            <h4 class="card-title">Sitemap</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="user_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                        <div class="form-group">
                            <label>Sitemap Url</label>
                            <input type="text" class="form-control" name="sitemap_url" id="sitemap_url" placeholder="Enter Website Name" value="<?php echo base_url().'sitemap.xml'; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Sitemap File</label>
                            <a target="_blank" href="<?php echo base_url().'sitemap.xml'; ?>" class="btn btn-success btn-sm" title="View Sitemap"><i class="fa fa-link" aria-hidden="true"></i> View Sitemap File</a>
                        </div>
                        <div class="form-group">
                            <label>Rebuild Your Sitemap</label>
                            <a href="#" class="btn btn-primary btn-sm" title="Rebuild Your Sitemap" id="rebuild_sitemap"><i class="fa fa-link" aria-hidden="true"></i> Rebuild Your Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>