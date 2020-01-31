
<div class="box-header">
<?php 
	
	if(isset($buttons)){
		foreach ($buttons as $key => $value) {
			switch ($value) {
				case 'add':
					echo '<button style="width:55px; height:27px;" id="btn_add" class="btn_add btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Add</p></button>';
					break;
				case 'sync':
					echo '<button style="width:100px; height:27px;display: none;" id="btn_add" class="btn_sync_multiple btn-sm btn btn-default cms-btn" ><p style="font-size:11px;" >Sync Selected</p></button>';
					break;
				case 'add_file':
					echo '<button style="width:75px; height:27px;" id="btn_add_file" class="btn_add_file btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Add File</p></button>';
					break;
				case 'back':
					echo '<button id="btn_back" style="width:55px; height:27px;" class="btn_back btn-sm btn btn-default cms-btn"><p style="font-size:11px">Back</p></button>';
					break;
				case 'update':
					echo '<button style="width:55px; height:27px;" id="btn_update" class="btn_update btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Update</p></button>';
					break;
				case 'cancel':
					echo '<button style="width:55px; height:27px;" id="btn_cancel" class="btn_cancel btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Cancel</p></button>';
					break;
				case 'sync':
					echo '<a href="#" style="width:55px; height:27px;" id="btn_sync" class="btn_update btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Sync</p></a>';
					break;

				case 'save':
					echo '<button style="width:55px; height:27px;" id="btn_save" class="btn_save btn-sm btn btn-default cms-btn"><p style="font-size:11px">Save</p> </button>';
					break;

				case 'close':
					echo '<a href="#" style="width:50px; height:25px;"  id="btn_close" class="btn_close btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Close</p></a>';
					break;

                case 'delete':
                    echo '<a href="#" style="width:55px; height:27px;" id="btn_delete" class="btn_delete btn-sm btn btn-default cms-btn" ><p style="font-size:11px">Delete</p> </a>';
                    break;

				case 'reset':
					echo '<a href="#" id="btn_reset" path="" class="btn_reset btn-sm btn btn-default pull-right cms-btn"  >Reset </a>';
					break;


				case 'search':
					echo '<div id="form_search" class="form-search form-horizontal pull-right">
							<div class="form-group has-feedback ">
						        <input type="text" class="form-control search-query" id="search_query" placeholder="Search.."  >
						        <span class="glyphicon glyphicon-search form-control-feedback"></span>
						      </div>
						</div>';
					break;

				case 'export':
                      echo '<a href="#" id="btn_export" class="btn_export btn-sm btn btn-default cms-btn" ><span class="fa fa-file-export"></span> Export </a>';
                      break;

                case 'date_range':
                      echo '<div class="form-group drange">
	                            <input type="text" class="range-date start-date form-control" placeholder="Date From" style="width: 95px;"  >
	                            <input type="text" class="range-date end-date form-control" placeholder="Date To" style="width: 95px;"   disabled>
	                            <button type="button" id="btn_filter" class="btn btn-default btn-filter btn-sm cms-btn"  ><i class="fa fa-filter"></i> Filter</button>
	                            <a href="#" path="" id="btn_reset" class="btn_reset btn-sm btn btn-default col-bday-4 cms-btn" ><span class="fa fa fa-refresh"></span> Reset </a>
                            </div>';
                      break;
                      
               case 'category':
                  echo '<a href="#" id="btn_category" class="btn_category btn-sm btn btn-default cms-btn"><span class="fa fa fa-plus "></span> Category</a>';
                  break;
					
				default:
					# code...
					break;
			}
		}
	}

?>
</div>

<style type="text/css">
	.drange{
	    display: inline-block;
	    position: relative;
	}

	.box-header .btn {
	    margin-right: 5px;
	}

	.form-search{
		display: inline-block;
	    position: fixed;
	    right:2em;
	}

	.range-date.start-date {
	    width: 90px;
	    display: inline-block;
		height: 31px;
		border-radius: 7px;
	}

	.range-date.end-date {
	    width: 90px;
	    display: inline-block;
	    height: 31px;
		border-radius: 7px;
	}

	.menu-tips{
		padding: 10px;
		font-size: 13px;
		width: 260px;
		background: #fff;
		color: #444;
		font-family: 'Montserrat';
		text-align: center;
	}

	.menu-tips {
	  	top: 100%;
	}

	.menu-tips::before {
		content: " ";
		position: absolute;
		border-width: 10px;
		border-style: solid;
	}

	.menu-tips::before {
	    bottom: 100%;
	    border-color: transparent transparent white transparent;
	}

	.cms-btn{
		width: 90px;
	}

	.btn-filter, .btn_reset{
		margin-bottom: 4px;
	}

	.input-group-glue {
		width: 0;
		display: table-cell;
	}

	.input-group-glue + .form-control {
		border-left: none;
	}

	.btn_sitemap{
		width: 130px;
	}

    .form-horizontal .has-feedback .form-control-feedback {
        right: 5px;
        top: -2px;
    }


</style>