// jQuery UI style "widget" for selecting and sorting "fields"
$(function()
{
	
	//flowerbulb modifications (Amn-Negar)
	
	$("#2_start_date").attr("placeholder", "YYYY-MM-DD hh:mm");	
	$("#2_end_date").attr("placeholder", "YYYY-MM-DD hh:mm");
	$("input[name=attr_start_date_temp]").attr("placeholder", "YYYY-MM-DD hh:mm");	
	$("input[name=attr_end_date_temp]").attr("placeholder", "YYYY-MM-DD hh:mm");	
	$("input[name=attr_approval_date_temp]").attr("placeholder", "YYYY-MM-DD hh:mm");	
	$("input[name=attr_acceptance_date_temp]").attr("placeholder", "YYYY-MM-DD hh:mm");	
	
	// flowerbulb convert all dates into Shamsi date
	// in history areas of admin panel
	
	setTimeout(convertAllGregs2Shamsi,1500);
	setTimeout(convertAllGregs2Shamsi,2500);
	setTimeout(convertAllGregs2Shamsi,4000);
	$( 'a[href*="pages/ajax.render.php?operation=history"]' ).click(function(){setTimeout(convertAllGregs2Shamsi,1500);setTimeout(convertAllGregs2Shamsi,3500)});
	
	function convertAllGregs2Shamsi(){
		if(document.getElementById("history") != null){
			var text = document.body.innerHTML;
			var reg = /2[0-9]{3}-[0-9]{2}-[0-9]{2}/g;
			var point;
			do {
				point = reg.exec(text);
				if (point && point != null) {
					var parts=point.toString().split("-");
					var shamsiDate = shamsiDate = gregorianToJalali(parts[0],parts[1],parts[2]);
					var shamsiDate = shamsiDate[0]+"-"+("0"+shamsiDate[1]).slice(-2)+"-"+("0"+shamsiDate[2]).slice(-2);
					document.getElementById("history").innerHTML=document.getElementById("history").innerHTML.replace(point.toString(),shamsiDate);
					console.log("www.NeginNet.com : Shamsi date of "+point+" replaced");
				}				
			} while (point);
			console.log("www.NeginNet.com : Converting dates into Shamsi completed");
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


    ///////////////////////////////////
	
	
	//
	//// end of converting date
	//
	
	/*!
	 * Web-Page-Elements Auto Direction. (RTL To LTR)
	 * NeginNet.com 2016
	 */
	window.onload = function(){
		var rtlElement;

		rtlElement = function(el) {
			  var content;
			  content = el.innerHTML;
			  if (/[\u0600-\u06FF]/.test(content)) {
				el.classList.add("rtlClass");
			  }
			  else {
				el.classList.add("ltrClass");
			  }
		};

		Array.prototype.slice.call(document.querySelectorAll('fieldset>table>tbody>tr>td,td>div,td>a,td>p,td>div>p,div.field_value_removedbyflower,div.html>p')).forEach(rtlElement);
	
	}
	////// Eof flowerbulb
	////
	//
	
	// the widget definition, where "itop" is the namespace,
	// "datatable" the widget name
	$.widget( "itop.datatable",
	{
		// default options
		options:
		{
			sPersistentId: '',
			sFilter: '',
			oColumns: {},
			sSelectMode: '',
			sViewLink: 'true',
			iNbObjects: 0,
			iDefaultPageSize: -1,
			iPageSize: -1,
			iPageIndex: 0,
			oClassAliases: {},
			sTableId : null,
			oExtraParams: {},
			sRenderUrl: 'index.php',
			oRenderParameters: {},
			oDefaultSettings: {},
			oLabels: { moveup: 'Move Up', movedown: 'Move Down' }
		},
	
		// the constructor
		_create: function()
		{
			this.aDlgStateParams = ['iDefaultPageSize', 'oColumns'];

			this.element
			.addClass('itop-datatable');
			
			var me = this;
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			var bViewLink = (this.options.sViewLink == 'true');
			$('#sfl_'+sListId).fieldsorter({hasKeyColumn: bViewLink, labels: this.options.oLabels, fields: this.options.oColumns, onChange: function() { me._onSpecificSettings(); } });
			$('#datatable_dlg_'+sListId).find('input[name=page_size]').click(function() { me._onSpecificSettings(); });
			$('#datatable_dlg_'+sListId).find('input[name=save_settings]').click(function() { me._updateSaveScope(); });
			this.element.find('.itop_popup > ul li').popupmenu();
			this._updateSaveScope();
			this._saveDlgState();
		},
	
		// called when created, and later when changing options
		_refresh: function()
		{
			oParams = this.options.oRenderParameters;
			oParams.operation = 'datatable';
			
			oParams.filter = this.options.sFilter;
			oParams.extra_param = this.options.oExtraParams;
			oParams.start = 0;
			oParams.end = this.options.iPageSize;
			oParams.select_mode = this.options.sSelectMode;
			oParams.display_key = this.options.sViewLink;
			oParams.class_aliases = this.options.oClassAliases;
			oParams.columns = this.options.oColumns;
			var iSortCol = 0;
			var aCurrentSort = [];
			for(var k1 in oParams.columns) //Aliases
			{
				for(var k2 in oParams.columns[k1]) //Attribute codes
				{
					if (oParams.columns[k1][k2].sort != 'none')
					{
						oParams.sort_col = iSortCol;
						oParams.sort_order = oParams.columns[k1][k2].sort;
						aCurrentSort.push([iSortCol, (oParams.columns[k1][k2].sort == 'asc') ? 0 : 1]);
						break; //TODO make this more generic, Sort on just one column for now
					}
					iSortCol++;
				}
				break; //TODO: DBObjectSet supports only sorting on the first alias of the set
			}			
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			oParams.list_id = sListId;
			var me = this;
			this.element.block();
			$.post(this.options.sRenderUrl, oParams, function(data) {
				// Nasty workaround to clear the pager's state for paginated lists !!!
				// See jquery.tablesorter.pager.js / saveParams / restoreParams
				if (window.pager_params)
				{
					window.pager_params['pager'+sListId] = undefined;
				}
				// End of workaround

				me.element.find('.datacontents').html(data);
				// restore the sort order on columns
				me.element.find('table.listResults').trigger('fakesorton', [aCurrentSort]);
				me.element.unblock();
			}, 'html' );
			
		},
		_useDefaultSettings: function(bResetAll)
		{
			var oParams = this.options.oRenderParameters;
			oParams.operation = 'datatable_reset_settings';
			
			oParams.table_id = this.options.sTableId;
			oParams.defaults = bResetAll;
			oParams.class_aliases = this.options.oClassAliases;
			
			var me = this;
			$.post(this.options.sRenderUrl, oParams, function(data) {
				// Do nothing...
			}, 'html' );			
		},
		_saveSettings: function(bSaveAsDefaults)
		{
			var oParams = this.options.oRenderParameters;
			oParams.operation = 'datatable_save_settings';
			
			oParams.page_size = this.options.iPageSize;
			oParams.table_id = this.options.sTableId;
			oParams.defaults = bSaveAsDefaults;
			oParams.class_aliases = this.options.oClassAliases;
			oParams.columns = this.options.oColumns;
			var iSortCol = 0;
			var sSortOrder = '';
			for(var i in this.options.oColumns)
			{
				if (this.options.oColumns[i].checked)
				{
					if (this.options.oColumns[i].sort != 'none')
					{
						sSortOrder = this.options.oColumns[i].sort;
					}
					else
					{
						iSortCol++;
					}
				}
			}
			if ((this.options.sSelectMode != '') && (this.options.sSelectMode != 'none'))
			{
				iSortCol++;
			}
			oParams.sort_col = iSortCol;
			oParams.sort_order = sSortOrder;
			var me = this;
			$.post(this.options.sRenderUrl, oParams, function(data) {
				// Do nothing...
			}, 'html' );
		},
		onDlgOk: function()
		{
			var oOptions = {};
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			oSettings = $('#datatable_dlg_'+sListId).find('input[name=settings]:checked');
			if (oSettings.val() == 'defaults')
			{
				oOptions = { iPageSize: this.options.oDefaultSettings.iDefaultPageSize, 
							 oColumns: this.options.oDefaultSettings.oColumns
						   };
			}
			else
			{
				var oDisplayColumns = {};
				var iColIdx = 0;
				var iSortIdx = 0;
				var sSortDirection = 'asc';
				var oColumns = $('#datatable_dlg_'+sListId).find(':itop-fieldsorter').fieldsorter('get_params');
				var iPageSize = parseInt($('#datatable_dlg_'+sListId+' input[name=page_size]').val(), 10);
				
				oOptions = {oColumns: oColumns, iPageSize: iPageSize, iDefaultPageSize: iPageSize };
			}
			this._setOptions(oOptions);

			// Check if we need to save the settings or not...
			var oSaveCheck = $('#datatable_dlg_'+sListId).find('input[name=save_settings]');
			var oSaveScope = $('#datatable_dlg_'+sListId).find('input[name=scope]:checked');
			if (oSaveCheck.attr('checked'))
			{
				if (oSettings.val() == 'defaults')
				{
					this._useDefaultSettings((oSaveScope.val() == 'defaults'));					
				}
				else
				{
					this._saveSettings((oSaveScope.val() == 'defaults'));
				}
			}
			this._saveDlgState();
			
		},
		onDlgCancel: function()
		{
			this._restoreDlgState();
		},
		_onSpecificSettings: function()
		{
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			$('#datatable_dlg_'+sListId).find('input.specific_settings').attr('checked', 'checked');
		},
		_updateSaveScope: function()
		{
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			var oSaveCheck = $('#datatable_dlg_'+sListId).find('input[name=save_settings]');
			if (oSaveCheck.attr('checked'))
			{
				$('#datatable_dlg_'+sListId).find('input[name=scope]').each(function() {
					if ($(this).attr('stay-disabled') != 'true')
					{
						$(this).removeAttr('disabled');
					}
				});
			}
			else
			{
				$('#datatable_dlg_'+sListId).find('input[name=scope]').attr('disabled', 'disabled');
			}
		},
		// events bound via _bind are removed automatically
		// revert other modifications here
		_destroy: function()
		{
			this.element
			.removeClass('itop-datatable');
			
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			$('#sfl_'+sListId).remove();
			$('#datatable_dlg_'+sListId).remove();			
		},
		// _setOptions is called with a hash of all options that are changing
		_setOptions: function()
		{
			// in 1.9 would use _superApply
			this._superApply(arguments);
			this._refresh();
		},
		// _setOption is called for each individual option that is changing
		_setOption: function( key, value )
		{
			// in 1.9 would use _super
			this._superApply(arguments);
		},
		UpdateState: function( config )
		{
			var iPageSize = config.page_size;
			if (iPageSize == -1)
			{
				iPageSize = 0;
			}
			this.options.iPageSize = iPageSize;

			var iPos = 0;
			for (alias in this.options.oColumns)
			{
				for (attcode in this.options.oColumns[alias])
				{
					this.options.oColumns[alias][attcode]['sort'] = 'none';
					if (this.options.oColumns[alias][attcode]['checked'])
					{
						if (iPos == config.sort_index)
						{
							this.options.oColumns[alias][attcode]['sort'] = config.sort_order;
						}
						iPos++;
					}
				}
			}

			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			var dlgElement = $('#datatable_dlg_'+sListId);
			dlgElement.find('input[name=page_size]').val(iPageSize);
			dlgElement.find(':itop-fieldsorter').fieldsorter('option', { fields: this.options.oColumns });
		},
		_saveDlgState: function()
		{
			this.originalState = {};
			for(k in this.aDlgStateParams)
			{
				this.originalState[this.aDlgStateParams[k]] = this.options[this.aDlgStateParams[k]];
			}
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			this.originalState.oFields = $('#datatable_dlg_'+sListId).find(':itop-fieldsorter').fieldsorter('get_params');
		},
		_restoreDlgState: function()
		{
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			var dlgElement = $('#datatable_dlg_'+sListId);

			for(k in this.aDlgStateParams)
			{
				this._setOption(this.aDlgStateParams[k], this.originalState[this.aDlgStateParams[k]]);
			}
			
			dlgElement.find('input[name=page_size]').val(this.originalState.iDefaultPageSize);
			
			dlgElement.find(':itop-fieldsorter').fieldsorter('option', { fields: this.originalState.oFields });
		},
		IsDialogOpen: function()
		{
			var sId = new String(this.element.attr('id'));
			var sListId = sId.replace('datatable_', '');
			var oDlgOpen = $('#datatable_dlg_'+sListId+' :visible');
			
			return (oDlgOpen.length > 0);
		},
		DoRefresh: function()
		{
			this._refresh();
		},
		GetMultipleSelectionParams: function()
		{
			var oRes = {};

			oRes.selectionMode = '';
			if (this.element.find(':input[name=selectionMode]').length > 0)
			{
				oRes.selectionMode = this.element.find(':input[name=selectionMode]').val();
			}

			oRes.selectObject = [];
			this.element.find(':input[name^=selectObject]:checked').each(function() {
				oRes.selectObject.push($(this).val());
			});

			oRes.storedSelection = [];
			this.element.find(':input[name^=storedSelection]').each(function() {
				oRes.storedSelection.push($(this).val());
			});

			return oRes;
		}
	});	
});