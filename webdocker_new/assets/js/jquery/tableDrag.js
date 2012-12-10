
	var dragedTable_x0,dragedTable_y0,dragedTable_x1,dragedTable_y1;
	var dragedTable_movable = false;
	var dragedTable_preCell = null;
	var dragedTable_normalColor = null;
	
	var dragedTable_preColor = "lavender";

	var dragedTable_endColor = "#FFCCFF";
	var dragedTable_movedDiv = "dragedTable_movedDiv";
	var dragedTable_tableId = "";
	
	
	function DragedTable(tableId)
	{
		dragedTable_tableId = tableId;
		var oTempDiv = $("<div></div>");
		oTempDiv.attr("id",dragedTable_movedDiv);
		oTempDiv.onselectstart = function(){return false};
		oTempDiv.css({cursor:"pointer",position:"absolute",border:"1px solid black",background:"#FFCCFF",display:"none"});
		$("body").append(oTempDiv);
		$("#"+tableId).mousedown(function(event){
			showDiv(event);
		}); 
	}
	
	
	function getPos(cell)
	{
		var pos = new Array();
		var offset = $(cell).offset();
	
		var t=offset.top;
		var l=offset.left;

		pos[0] = t;
		pos[1] = l;

		return pos;
	}
	

	function showDiv(event)
	{
		var obj = $(event.target);
		var pos = new Array();

		
		var oDiv = $("#"+dragedTable_movedDiv);
		if(obj[0].tagName.toLowerCase() == "td")
		{
			obj.css({cursor:"pointer"});
			pos = getPos(obj);

			oDiv.css({width:obj.width(), height:obj.height(), top:pos[0], left:pos[1]});
			
			oDiv.html(obj.html());
			
			oDiv.css({display:"block"});
			dragedTable_x0 = pos[1];
			dragedTable_y0 = pos[0];
			dragedTable_x1 = event.clientX;
			dragedTable_y1 = event.clientY;
		
			dragedTable_normalColor = obj.css("background-color");
			obj.css({background:dragedTable_preColor});
			dragedTable_preCell = obj;
			
			dragedTable_movable = true;
		}
	}
	function dragDiv(event)
	{
		if(dragedTable_movable)
		{
			var oDiv = $("#"+dragedTable_movedDiv);
			var pos = new Array();
			var t =  event.clientY - dragedTable_y1 + dragedTable_y0;
			var l = event.clientX - dragedTable_x1 + dragedTable_x0;
			oDiv.css({top:t,left:l});
			var oTable = $("#"+dragedTable_tableId);
			for(var i=0; i<oTable.find("td").length; i++)
			{
				var cell = oTable.find("td").get(i);
				if(cell.tagName.toLowerCase() == "td")
				{
					pos = getPos(cell);
					if(event.pageX>pos[1]&&event.pageX<pos[1]+$(cell).width()
					&& event.pageY>pos[0]&& event.pageY<pos[0]+$(cell).height())
					{
						if(cell != dragedTable_preCell)
						$(cell).css({background:dragedTable_endColor});
					}
					else
					{
						if(cell != dragedTable_preCell)
						$(cell).css({background:dragedTable_normalColor});
					}
				}
			}
		}
	}
	
	function hideDiv(event)
	{
		if(dragedTable_movable)
		{
			var oTable = $("#"+dragedTable_tableId);
			var pos = new Array();
			if(dragedTable_preCell != null)
			{
				var cells = oTable.find("tbody").find("td");
				for(var i=0; i<cells.length; i++)
				{
					cell = cells.get(i);
					pos = getPos(cell);
					if(event.pageX>pos[1]&&event.pageX<pos[1]+$(cell).width()
					&& event.pageY>pos[0]&& event.pageY<pos[0]+$(cell).height())
					{
						if(cell.tagName.toLowerCase() == "td")
						{
					
							dragedTable_preCell.html($(cell).html());
							$(cell).html($("#"+dragedTable_movedDiv).html()) ;
				
							dragedTable_preCell.css({background:dragedTable_normalColor});
							$(cell).css({background: dragedTable_normalColor,cursor:""});
							
							dragedTable_preCell.css({background: dragedTable_normalColor,cursor:""});
							
						}
					}
				}
			}
			dragedTable_movable = false;

			$("#"+dragedTable_movedDiv).css({display:"none"});;
		}
	}
	
	$(document).mouseup(function(event)
	{
		hideDiv(event);
		var oTable = $("#"+dragedTable_tableId);
		var cells = oTable.find("td");
		for(var i=0; i<cells.length; i++){
			var cell = cells.get(i);
			$(cell).css({background:dragedTable_normalColor});
		}
	});
	
	$(document).mousemove(function(event)
	{
		dragDiv(event);
	});
	
	function dragInit(tableId)
	{
		DragedTable(tableId);
	}
	