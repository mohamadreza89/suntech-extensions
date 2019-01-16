
// Flowerbulb Amn-Negar 
// Convert all Gregorian dates into Shamsi dates in Portal UI


	window.onload = function(){
		convertAllGregs2Shamsi();	
		$( "a[href*=\"pages/exec.php/object/edit/UserRequest\"]" ).click(
			function(){
				setTimeout(convertAllGregs2Shamsi_onDialog,1000);
				setTimeout(convertAllGregs2Shamsi_onDialog,2000);
				setTimeout(convertAllGregs2Shamsi_onDialog,4000);
				});
		$( "a[href*=\"pages/exec.php/object/edit/Incident\"]" ).click(
			function(){
				setTimeout(convertAllGregs2Shamsi_onDialog,1000);
				setTimeout(convertAllGregs2Shamsi_onDialog,2000);
				setTimeout(convertAllGregs2Shamsi_onDialog,4000);
				});
	}
	
	function convertAllGregs2Shamsi(){
		if(document.body != null){
			var text = document.body.innerHTML;
			var reg = /2[0-9]{3}-[0-9]{2}-[0-9]{2}/g;
			var point;
			do {
				var point = reg.exec(text);
				if (point) {
					var parts=point.toString().split("-");
					var shamsiDate = shamsiDate = gregorianToJalali(parts[0],parts[1],parts[2]);
					shamsiDate = shamsiDate[0]+"-"+("0"+shamsiDate[1]).slice(-2)+"-"+("0"+shamsiDate[2]).slice(-2);
					if(document.getElementById("table-UserRequest_wrapper")!=null)
						document.getElementById("table-UserRequest_wrapper").innerHTML=document.getElementById("table-UserRequest_wrapper").innerHTML.replace(point.toString(),shamsiDate);
					if(document.getElementById("table-Incident_wrapper")!=null)
						document.getElementById("table-Incident_wrapper").innerHTML=document.getElementById("table-Incident_wrapper").innerHTML.replace(point.toString(),shamsiDate);
					console.log("www.NeginNet.com : Shamsi date of "+point+" replaced");
				}
			} while (point);
			console.log("www.NeginNet.com : Converting dates into Shamsi completed");
		}
	}
	
	function convertAllGregs2Shamsi_onDialog(){
		if(document.body != null){
			var els = document.getElementsByClassName("form-control-static");
			Array.prototype.forEach.call(els, function(el) {
				var text = el.innerHTML;
				var reg = /2[0-9]{3}-[0-9]{2}-[0-9]{2}/g;
				var point;
				do {
					var point = reg.exec(text);
					if (point) {
						var parts=point.toString().split("-");
						var shamsiDate = shamsiDate = gregorianToJalali(parts[0],parts[1],parts[2]);
						shamsiDate = shamsiDate[0]+"-"+("0"+shamsiDate[1]).slice(-2)+"-"+("0"+shamsiDate[2]).slice(-2);
						el.innerHTML = el.innerHTML.replace(point.toString(),shamsiDate);
						//document.getElementsByClassName("form_fields")[4].innerHTML=document.getElementsByClassName("form_fields")[4].innerHTML.replace("Service subcategory",shamsiDate);
						console.log("www.NeginNet.com : Shamsi date of "+point+" replaced");
					}
				} while (point);
				console.log("www.NeginNet.com : Converting dates into Shamsi completed");
			});
		}
	}

	JalaliDate = {
		g_days_in_month: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
		j_days_in_month: [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29]
	};

	function gregorianToJalali(g_y, g_m, g_d){
		g_y = parseInt(g_y);
		g_m = parseInt(g_m);
		g_d = parseInt(g_d);
		var gy = g_y-1600;
		var gm = g_m-1;
		var gd = g_d-1;

		var g_day_no = 365*gy+parseInt((gy+3) / 4)-parseInt((gy+99)/100)+parseInt((gy+399)/400);

		for (var i=0; i < gm; ++i)
		g_day_no += JalaliDate.g_days_in_month[i];
		if (gm>1 && ((gy%4==0 && gy%100!=0) || (gy%400==0)))
		/* leap and after Feb */
		++g_day_no;
		g_day_no += gd;

		var j_day_no = g_day_no-79;

		var j_np = parseInt(j_day_no/ 12053);
		j_day_no %= 12053;

		var jy = 979+33*j_np+4*parseInt(j_day_no/1461);

		j_day_no %= 1461;

		if (j_day_no >= 366) {
			jy += parseInt((j_day_no-1)/ 365);
			j_day_no = (j_day_no-1)%365;
		}

		for (var i = 0; i < 11 && j_day_no >= JalaliDate.j_days_in_month[i]; ++i) {
			j_day_no -= JalaliDate.j_days_in_month[i];
		}
		var jm = i+1;
		var jd = j_day_no+1;


		return [jy, jm, jd];
	}


///////////////////////////////////////////////
//iTop Form handler
;
$(function()
{
	// the widget definition, where 'itop' is the namespace,
	// 'form_handler' the widget name
	$.widget( 'itop.form_handler',
	{
		// default options
		options:
		{
			formmanager_class: null,
			formmanager_data: null,
			submit_btn_selector: null,
			cancel_btn_selector: null,
			endpoint: null,
			is_modal: false,
			field_set: null
		},

		// the constructor
		_create: function()
		{
			var me = this;
			
			this.element
			.addClass('form_handler');

			// Binding events
			this.element.bind('update_fields', function(oEvent, oData){
				me._onUpdateFields(oEvent, oData);
			});

			// Binding buttons
			if(this.options.submit_btn_selector !== null)
			{
				this.options.submit_btn_selector.off('click').on('click', function(oEvent){ me._onSubmitClick(oEvent); });
			}
			if(this.options.cancel_btn_selector !== null)
			{
				this.options.cancel_btn_selector.off('click').on('click', function(oEvent){ me._onCancelClick(oEvent); });
			}
		},
   
		// called when created, and later when changing options
		_refresh: function()
		{
			
		},
		// events bound via _bind are removed automatically
		// revert other modifications here
		_destroy: function()
		{
			this.element
			.removeClass('form_handler');
		},
		// _setOptions is called with a hash of all options that are changing
		// always refresh when changing options
		_setOptions: function()
		{
			this._superApply(arguments);
		},
		// _setOption is called for each individual option that is changing
		_setOption: function( key, value )
		{
			this._super( key, value );
		},
		getCurrentValues: function()
		{
			return this.options.field_set.triggerHandler('get_current_values');
		},
		_onUpdateFields: function(oEvent, oData)
		{
			var me = this;
			var sFormPath = oData.form_path;

			// Data checks
			if(this.options.endpoint === null)
			{
				console.log('Form handler : An endpoint must be defined.');
				return false;
			}
			if(this.options.formmanager_class === null)
			{
				console.log('Form handler : Form manager class must be defined.');
				return false;
			}
			if(this.options.formmanager_data === null)
			{
				console.log('Form handler : Form manager data must be defined.');
				return false;
			}
			
			this._disableFormBeforeLoading();
			$.post(
				this.options.endpoint,
				{
					operation: 'update',
					formmanager_class: this.options.formmanager_class,
					formmanager_data: JSON.stringify(this.options.formmanager_data),
					current_values: this.getCurrentValues(),
					requested_fields: oData.requested_fields,
					form_path: sFormPath
				},
				function(oData){
					me._onUpdateSuccess(oData, sFormPath);
				}
			)
			.fail(function(oData){ me._onUpdateFailure(oData, sFormPath); })
			.always(function(oData){ me._onUpdateAlways(oData, sFormPath); });
		},
		// Intended for overloading in derived classes
		_onSubmitClick: function(oEvent)
		{
		},
		// Intended for overloading in derived classes
		_onCancelClick: function(oEvent)
		{
		},
		// Intended for overloading in derived classes
		_onUpdateSuccess: function(oData, sFormPath)
		{
			if(oData.form.updated_fields !== undefined)
			{
				this.element.find('[data-form-path="' + sFormPath + '"]').trigger('update_form', {updated_fields: oData.form.updated_fields});
			}
		},
		// Intended for overloading in derived classes
		_onUpdateFailure: function(oData, sFormPath)
		{
		},
		// Intended for overloading in derived classes
		_onUpdateAlways: function(oData, sFormPath)
		{
			// Check all touched AFTER ajax is complete, otherwise the renderer will redraw the field in the mean time.
			this.element.find('[data-form-path="' + sFormPath + '"]').trigger('validate');
			this._enableFormAfterLoading();
		},
		// Intended for overloading in derived classes
		_disableFormBeforeLoading: function()
		{
		},
		// Intended for overloading in derived classes
		_enableFormAfterLoading: function()
		{
		},
		showOptions: function() // Debug helper
		{
			console.log(this.options);
		}
	});
});
