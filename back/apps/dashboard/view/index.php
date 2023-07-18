<div class="container-fluid">
	<div class="">
    	<div class="col-md-12"><br>
        
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4 col-sm-12 text-center bg-primary">
                                <i class="fa fa-book icon" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-8">
                                <a href="?app=volumes">
                                <div class="card-body">
                                    <h5 class="card-title">Total Volumes</h5>
                                    <p class="card-text"><div class="det"><?php echo $dbc->Getcount("article_volumes","status > 0");?> </div></p>
                                    <p class="card-text"><small class="text-muted">Last updated <?php echo date('Y-m-d');?></small></p>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4 col-sm-12 text-center bg-warning">
                                <i class="fa fa-flag-checkered icon" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-8">
                                <a href="?app=volumes">
                                <div class="card-body">
                                    <h5 class="card-title">Latest Issue</h5>
                                    <p class="card-text"><div class="det">1</div></p>
                                    <p class="card-text"><small class="text-muted"><?php $latest = $dbc->GetRecord("article_volumes","*","latest > 0"); echo $latest['name'];?></small></p>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4 col-sm-12 text-center bg-success">
                                <i class="fa fa-bookmark icon" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-8">
                                <a href="?app=articles">
                                <div class="card-body">
                                    <h5 class="card-title">Total Articles</h5>
                                    <p class="card-text"><div class="det"><?php echo $dbc->Getcount("articles","status > 0");?></div></p>
                                    <p class="card-text"><small class="text-muted">Last updated <?php echo date('Y-m-d');?></small></p>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            
            	<div class="col-md-4 col-sm-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4 col-sm-12 text-center bg-danger">
                                <i class="fa fa-users icon" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-8">
                                <a href="?app=customers">
                                <div class="card-body">
                                    <h5 class="card-title">Total Customers</h5>
                                    <p class="card-text"><div class="det"><?php echo $dbc->Getcount("customers","status >= 0");?></div></p>
                                    <p class="card-text"><small class="text-muted">Last updated <?php echo date('Y-m-d');?></small></p>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
        </div>
    </div>
</div>
<style>
a
{
	color:unset;
}
</style>