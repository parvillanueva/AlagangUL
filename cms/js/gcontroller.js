var Globalurl = "";

var InsertData_url = "";
var InsertData_table = "";
var InsertData_data = {};

var UpdateData_url = "";
var UpdateData_table = "";
var UpdateData_data = {};
var UpdateData_key = "";
var UpdateData_val = "";

var StatusData_url = "";
var StatusData_table = "";
var StatusData_data = {}
var StatusData_key = "";
var StatusData_val = "";

var DeleteData_url = "";
var DeleteData_table = "";
var DeleteData_data = {}
var DeleteData_key = "";
var DeleteData_val = "";

var Select_table = "";
var Select_url = "";
var Select_select = "";
var Select_limit = 9999;
var Select_offset = 0;

var Select_query = {};
var Select_query_where = [];
var Select_query_or_where = [];
var Select_custom_query = "";
var where_count = 0;
var or_where_count = 0;

var Select_order = {}
var order_count = 0;

var Select_group = [];
var group_count = 0;

var Select_join = [];
var join_count = 0;


var Pag_url = "";
var Pag_table = "";
var Pag_query = {};
var Pag_query_where = [];
var Pag_query_or_where = [];
var Pag_count_where = 0;
var Pag_count_or_where = 0;

var Pag_group = [];
var Pag_group_count = 0;

var Pag_join = [];
var Pag_join_count = 0;

var Pag_loaded = false;

var Pag_query = "";


AJAX = {
	config : {
		base_url: function (baseurl) {
	    	Globalurl = baseurl + "/content_management/gcontroller";
	    }
	},
	insert : {
		url: function (url) {
    		InsertData_url = url;
	    }, 
		table: function (table) {
    		InsertData_table = table;
	    }, 
		params: function (key, val) {
			InsertData_data[key] = val;
	    }, 
	    exec: function(cb){

	    	var url = Globalurl;
			if(InsertData_url != ""){
				url = InsertData_url;
			}

	    	var data = {
	            event 	: "insert", 
	            table 	: InsertData_table, 
	            data 	: InsertData_data 
	        }

	        $.ajax({
		      	async	: true,
		      	cache	: false,
		      	type	: 'POST',
		      	url 	: Globalurl,
		      	data 	: data,
		      	beforeSend: function() {
		      		fn.loading(true);
					InsertData_url = "";
					InsertData_table = "";
					InsertData_data = {};
			    },
			    complete: function() {
			    	InsertData_url = "";
					InsertData_table = "";
					InsertData_data = {};
			        fn.loading(false);
			    },
			    error: function(xhr) { 
			    	InsertData_url = "";
					InsertData_table = "";
					InsertData_data = {};
			    	fn.loading(false);
			        console.log(xhr.statusText + xhr.responseText);
			    },
			    success	: cb
		    });

	    }
	},
	update : {
		url: function (url) {
    		UpdateData_url = url;
	    }, 
		table: function (table) {
    		UpdateData_table = table;
	    }, 
		params: function (key, val) {
			UpdateData_data[key] = val;
	    },
	    where:  function (key, val){
	    	UpdateData_key = key;
	    	UpdateData_val = val;
	    },
	    exec: function(cb){

	    	var url = Globalurl;
			if(UpdateData_url != ""){
				url = UpdateData_url;
			}

	    	var data = {
	            event 	: "update", 
	            table 	: UpdateData_table, 
	            data 	: UpdateData_data,
	            field 	: UpdateData_key,
				where 	: UpdateData_val, 
	        }

	        $.ajax({
		      	async	: false,
		      	cache	: false,
		      	type	: 'POST',
		      	url 	: url,
		      	data 	: data,
		      	beforeSend: function() {
					UpdateData_url = "";
					UpdateData_table = "";
					UpdateData_data = {};
					UpdateData_key = "";
					UpdateData_val = "";
		      		fn.loading(true);
			    },
			    complete: function() {
			    	UpdateData_url = "";
					UpdateData_table = "";
					UpdateData_data = {};
					UpdateData_key = "";
					UpdateData_val = "";
			        fn.loading(false);
			    },
			    error: function(xhr) { 
			    	fn.loading(false);
			    	UpdateData_url = "";
					UpdateData_table = "";
					UpdateData_data = {};
					UpdateData_key = "";
					UpdateData_val = "";
			        console.log(xhr.statusText + xhr.responseText);
			    },
			    success	: cb
		    });

	    }
	},
	status : {
		url: function (url) {
    		StatusData_url = url;
	    }, 
		table: function (table) {
    		StatusData_table = table;
	    }, 
	    status:  function (field, value){
	    	StatusData_data = {
	    		field : field,
	    		value : value
	    	}
	    },
	    where:  function (key, val){
	    	StatusData_key = key;
	    	StatusData_val = val;
	    },
	    exec: function(cb){

	    	var url = Globalurl;
			if(StatusData_url != ""){
				url = StatusData_url;
			}
			

	    	var data = {
	            event 	: "status", 
	            table 	: StatusData_table, 
	            data 	: StatusData_data,
	            field 	: StatusData_key,
				where 	: StatusData_val, 
	        }

	        $.ajax({
		      	async	: false,
		      	cache	: false,
		      	type	: 'POST',
		      	url 	: url,
		      	data 	: data,
		      	beforeSend: function() {
		      		fn.loading(true);
			    },
			    complete: function() {
			    	StatusData_url = "";
					StatusData_table = "";
					StatusData_data = {}
					StatusData_key = "";
					StatusData_val = "";
			        fn.loading(false);
			    },
			    error: function(xhr) { 
			    	StatusData_url = "";
					StatusData_table = "";
					StatusData_data = {}
					StatusData_key = "";
					StatusData_val = "";
			    	fn.loading(false);
			        console.log(xhr.statusText + xhr.responseText);
			    },
			    success	: cb
		    });

	    }
	},
	delete : {
		url: function (url) {
    		DeleteData_url = table;
	    }, 
		table: function (table) {
    		DeleteData_table = table;
	    }, 
	    field:  function (field){
	    	DeleteData_data = {
	    		field : field,
	    		value : -2
	    	}
	    },
	    where:  function (key, val){
	    	DeleteData_key = key;
	    	DeleteData_val = val;
	    },
	    exec: function(cb){

	    	var url = Globalurl;
			if(DeleteData_url != ""){
				url = DeleteData_url;
			}
			

	    	var data = {
	            event 	: "delete", 
	            table 	: DeleteData_table, 
	            data 	: DeleteData_data,
	            field 	: DeleteData_key,
				where 	: DeleteData_val, 
	        }

	        $.ajax({
		      	async	: false,
		      	cache	: false,
		      	type	: 'POST',
		      	url 	: url,
		      	data 	: data,
		      	beforeSend: function() {
					DeleteData_url = "";
					DeleteData_table = "";
					DeleteData_data = {}
					DeleteData_key = "";
					DeleteData_val = "";
		      		fn.loading(true);
			    },
			    complete: function() {
			    	DeleteData_url = "";
					DeleteData_table = "";
					DeleteData_data = {}
					DeleteData_key = "";
					DeleteData_val = "";
			        fn.loading(false);
			    },
			    error: function(xhr) { 
			    	DeleteData_url = "";
					DeleteData_table = "";
					DeleteData_data = {}
					DeleteData_key = "";
					DeleteData_val = "";
			    	fn.loading(false);
			        console.log(xhr.statusText + xhr.responseText);
			    },
			    success	: cb
		    });

	    }
	},
	select : {
		url : function(url){
			Select_url = url;
		},
		table : function(table){
			Select_table = table;
		},
		select : function(select){
			Select_select = select;
		},
		offset : function(offset){
			if(offset > 0){
				Select_offset = offset - 1;
			} else {
				Select_offset = offset;
			}
		},
		limit : function(limit){
			Select_limit = limit;
		},
		where : {
			like : function(key, val){
				Select_query_where[where_count] = {
					like : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			equal : function(key, val){
				Select_query_where[where_count] = {
					equal : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			not : function(key, val){
				Select_query_where[where_count] = {
					not : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			greater : function(key, val){
				Select_query_where[where_count] = {
					greater : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			less : function(key, val){
				Select_query_where[where_count] = {
					less : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			greater_equal : function(key, val){
				Select_query_where[where_count] = {
					greater_equal : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			less_equal : function(key, val){
				Select_query_where[where_count] = {
					less_equal : {
						field : key,
						value : val
					}
				};
				where_count++;
			},
			or : {
				equal : function(key, val){
					Select_query_or_where[or_where_count] = {
						equal : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
				like : function(key, val){
					Select_query_or_where[or_where_count] = {
						like : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
				not : function(key, val){
					Select_query_or_where[or_where_count] = {
						not : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
				greater : function(key, val){
					Select_query_or_where[or_where_count] = {
						greater : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
				less : function(key, val){
					Select_query_or_where[or_where_count] = {
						less : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
				greater_equal : function(key, val){
					Select_query_or_where[or_where_count] = {
						greater_equal : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
				less_equal : function(key, val){
					Select_query_or_where[or_where_count] = {
						less_equal : {
							field : key,
							value : val
						}
					};
					or_where_count++;
				},
			}
		},
		query: function(query){
			Select_custom_query = query;
		},
		order : {
			asc : function(field){
				Select_order[order_count] = {
					asc : field
				};
				order_count++
			},
			desc : function(field){
				Select_order[order_count] = {
					desc : field
				};
				order_count++
			},
			random : function(field){
				Select_order[order_count] = {
					random : field
				};
				order_count++
			}
		},
		group : function(field){
			Select_group[group_count] = {field};
			group_count++
		},
		join : {
			left : function(table, param1, param2){
				Select_join[join_count] = {
					left : {
						table : table,
						param1 : param1,
						param2 : param2
					}
				};
				join_count++;
			},
			right : function(table, param1, param2){
				Select_join[join_count] = {
					right : {
						table : table,
						param1 : param1,
						param2 : param2
					}
				};
				join_count++;
			},
			inner : function(table, param1, param2){
				Select_join[join_count] = {
					inner : {
						table : table,
						param1 : param1,
						param2 : param2
					}
				};
				join_count++;
			},
			outer : function(table, param1, param2){
				Select_join[join_count] = {
					outer : {
						table : table,
						param1 : param1,
						param2 : param2
					}
				};
				join_count++;
			},
		},
		exec: function(cb, pg){

			var url = Globalurl;
			if(Select_url != ""){
				url = Select_url;
			}

			Select_query = {
				where : Select_query_where,
				or_where : Select_query_or_where
			}
	    	var data = {
	            event 	: "select", 
	            offset 	: Select_offset, 
	            limit 	: Select_limit, 
	            table 	: Select_table, 
	            select 	: Select_select,
	            query 	: Select_query,
	            custom_q: Select_custom_query,
	            order 	: Select_order,
	            group 	: Select_group,
	            join 	: Select_join,
	        }

	        $.ajax({
		      	async	: true,
		      	cache	: false,
		      	type	: 'POST',
		      	url 	: url,
		      	data 	: data,
		      	beforeSend: function() {
		      		fn.loading(true);
			    },
			    complete: function() {
			        fn.loading(false);
			    },
			    error: function(xhr) { 
			    	fn.loading(false);
			        console.log(xhr.statusText + xhr.responseText);
			    },
			    success	: cb
		    });


			if(Select_offset > 0){
				Select_table = "";
				Select_url = "";
				Select_select = "";
				Select_limit = 9999;
				Select_offset = 0;

				Select_query = {};
				Select_query_where = [];
				Select_query_or_where = [];
				Select_custom_query = "";
				where_count = 0;
				or_where_count = 0;

				Select_order = {}
				order_count = 0;

				Select_group = [];
				group_count = 0;

				Select_join = [];
				join_count = 0;
			} else {
				var url = Globalurl;
				if(Select_url != ""){
					url = Select_url;
				}

				Select_query = {
					where : Select_query_where,
					or_where : Select_query_or_where
				}
				var data = {
			        event 	: "pagination", 
			        offset 	: 0, 
			        limit 	: Select_limit, 
			        table 	: Select_table, 
			        select 	: Select_select,
			        query 	: Select_query,
			        custom_q: Select_custom_query,
			        order 	: Select_order,
			        group 	: Select_group,
			        join 	: Select_join,
			    }

			    $.ajax({
			      	async	: false,
			      	cache	: false,
			      	type	: 'POST',
			      	url 	: url,
			      	data 	: data,
			      	beforeSend: function() {
			      		fn.loading(true);
				    },
				    complete: function() {
				    	
				    	Select_table = "";
						Select_url = "";
						Select_select = "";
						Select_limit = 9999;
						Select_offset = 0;

						Select_query = {};
						Select_query_where = [];
						Select_query_or_where = [];
						Select_custom_query = "";
						where_count = 0;
						or_where_count = 0;

						Select_order = {}
						order_count = 0;

						Select_group = [];
						group_count = 0;

						Select_join = [];
						join_count = 0;
				        fn.loading(false);
				    },
				    error: function(xhr) { 
				    	
				    	Select_table = "";
						Select_url = "";
						Select_select = "";
						Select_limit = 9999;
						Select_offset = 0;

						Select_query = {};
						Select_query_where = [];
						Select_query_or_where = [];
						Select_custom_query = "";
						where_count = 0;
						or_where_count = 0;

						Select_order = {}
						order_count = 0;

						Select_group = [];
						group_count = 0;

						Select_join = [];
						join_count = 0;
				    	fn.loading(false);
				        console.log(xhr.statusText + xhr.responseText);
				    },
				    success	: pg
			    });	
			}
		    
	    }
	},
	batch_update : {
		url: function (url) {
    		UpdateData_url = url;
	    }, 
		table: function (table) {
    		UpdateData_table = table;
	    }, 
		params: function (key, val) {
			UpdateData_data[key] = val;
		},
		field: function (key) {
			UpdateData_key = key;
		},
		where_in: function(where_in){
			Select_query_where_in = where_in;
		},
	    exec: function(cb){

	    	var url = Globalurl;
			if(UpdateData_url != ""){
				url = UpdateData_url;
			}

	    	var data = {
	            event 	: "batch_update", 
	            table 	: UpdateData_table, 
	            data 	: UpdateData_data,
	            field 	: UpdateData_key,
	            where_in : Select_query_where_in,
	        }

	        $.ajax({
		      	async	: false,
		      	cache	: false,
		      	type	: 'POST',
		      	url 	: url,
		      	data 	: data,
		      	beforeSend: function() {
		      		fn.loading(true);
			    },
			    complete: function() {
			    	UpdateData_url = "";
					UpdateData_table = "";
					UpdateData_data = {};
					UpdateData_key = "";
					UpdateData_val = "";
			        fn.loading(false);
			    },
			    error: function(xhr) { 
			    	fn.loading(false);
			    	UpdateData_url = "";
					UpdateData_table = "";
					UpdateData_data = {};
					UpdateData_key = "";
					UpdateData_val = "";
			    },
			    success	: cb
		    });

	    }
	}
}

var fn = {
	loading : function(isloading){
		
	}
}