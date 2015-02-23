/* Set the defaults for DataTables initialisation */
$.extend(true, $.fn.dataTable.defaults, {
    "sDom":
            "<'row'<'col-xs-6'l><'col-xs-6'f>r>" +
            "t" +
            "<'row'<'col-xs-6'i><'col-xs-6'p>>",
    "oLanguage": {
        "sLengthMenu": "_MENU_ records per page"
    }
});
/* Default class modification */
$.extend($.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline",
    "sFilterInput": "form-control input-sm",
    "sLengthSelect": "form-control input-sm"
});
// In 1.10 we use the pagination renderers to draw the Bootstrap paging,
// rather than  custom plug-in
if ($.fn.dataTable.Api) {
    $.fn.dataTable.defaults.renderer = 'bootstrap';
    $.fn.dataTable.ext.renderer.pageButton.bootstrap = function(settings, host, idx, buttons, page, pages) {
        var api = new $.fn.dataTable.Api(settings);
        var classes = settings.oClasses;
        var lang = settings.oLanguage.oPaginate;
        var btnDisplay, btnClass;
        var attach = function(container, buttons) {
            var i, ien, node, button;
            var clickHandler = function(e) {
                e.preventDefault();
                if (e.data.action !== 'ellipsis') {
                    api.page(e.data.action).draw(false);
                }
            };
            for (i = 0, ien = buttons.length; i < ien; i++) {
                button = buttons[i];
                if ($.isArray(button)) {
                    attach(container, button);
                }
                else {
                    btnDisplay = '';
                    btnClass = '';
                    switch (button) {
                        case 'ellipsis':
                            btnDisplay = '&hellip;';
                            btnClass = 'disabled';
                            break;
                        case 'first':
                            btnDisplay = lang.sFirst;
                            btnClass = button + (page > 0 ?
                                    '' : ' disabled');
                            break;
                        case 'previous':
                            btnDisplay = lang.sPrevious;
                            btnClass = button + (page > 0 ?
                                    '' : ' disabled');
                            break;
                        case 'next':
                            btnDisplay = lang.sNext;
                            btnClass = button + (page < pages - 1 ?
                                    '' : ' disabled');
                            break;
                        case 'last':
                            btnDisplay = lang.sLast;
                            btnClass = button + (page < pages - 1 ?
                                    '' : ' disabled');
                            break;
                        default:
                            btnDisplay = button + 1;
                            btnClass = page === button ?
                                    'active' : '';
                            break;
                    }

                    if (btnDisplay) {
                        node = $('<li>', {
                            'class': classes.sPageButton + ' ' + btnClass,
                            'aria-controls': settings.sTableId,
                            'tabindex': settings.iTabIndex,
                            'id': idx === 0 && typeof button === 'string' ?
                                    settings.sTableId + '_' + button :
                                    null
                        })
                                .append($('<a>', {
                                    'href': '#'
                                })
                                        .html(btnDisplay)
                                        )
                                .appendTo(container);
                        settings.oApi._fnBindAction(
                                node, {action: button}, clickHandler
                                );
                    }
                }
            }
        };
        attach(
                $(host).empty().html('<ul class="pagination"/>').children('ul'),
                buttons
                );
    }
}
else {
// Integration for 1.9-
    $.fn.dataTable.defaults.sPaginationType = 'bootstrap';
    /* API method to get paging information */
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    /* Bootstrap style pagination control */
    $.extend($.fn.dataTableExt.oPagination, {
        "bootstrap": {
            "fnInit": function(oSettings, nPaging, fnDraw) {
                var oLang = oSettings.oLanguage.oPaginate;
                var fnClickHandler = function(e) {
                    e.preventDefault();
                    if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                        fnDraw(oSettings);
                    }
                };
                $(nPaging).append(
                        '<ul class="pagination">' +
                        '<li class="prev disabled"><a href="#">&larr; ' + oLang.sPrevious + '</a></li>' +
                        '<li class="next disabled"><a href="#">' + oLang.sNext + ' &rarr; </a></li>' +
                        '</ul>'
                        );
                var els = $('a', nPaging);
                $(els[0]).bind('click.DT', {action: "previous"}, fnClickHandler);
                $(els[1]).bind('click.DT', {action: "next"}, fnClickHandler);
            },
            "fnUpdate": function(oSettings, fnDraw) {
                var iListLength = 5;
                var oPaging = oSettings.oInstance.fnPagingInfo();
                var an = oSettings.aanFeatures.p;
                var i, ien, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);
                if (oPaging.iTotalPages < iListLength) {
                    iStart = 1;
                    iEnd = oPaging.iTotalPages;
                }
                else if (oPaging.iPage <= iHalf) {
                    iStart = 1;
                    iEnd = iListLength;
                } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                    iStart = oPaging.iTotalPages - iListLength + 1;
                    iEnd = oPaging.iTotalPages;
                } else {
                    iStart = oPaging.iPage - iHalf + 1;
                    iEnd = iStart + iListLength - 1;
                }

                for (i = 0, ien = an.length; i < ien; i++) {
                    // Remove the middle elements
                    $('li:gt(0)', an[i]).filter(':not(:last)').remove();
                    // Add the new list items and their event handlers
                    for (j = iStart; j <= iEnd; j++) {
                        sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                        $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                                .insertBefore($('li:last', an[i])[0])
                                .bind('click', function(e) {
                                    e.preventDefault();
                                    oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                                    fnDraw(oSettings);
                                });
                    }

                    // Add / remove disabled classes from the static elements
                    if (oPaging.iPage === 0) {
                        $('li:first', an[i]).addClass('disabled');
                    } else {
                        $('li:first', an[i]).removeClass('disabled');
                    }

                    if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                        $('li:last', an[i]).addClass('disabled');
                    } else {
                        $('li:last', an[i]).removeClass('disabled');
                    }
                }
            }
        }
    });
}


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ($.fn.DataTable.TableTools) {
// Set the classes that TableTools uses to something suitable for Bootstrap
    $.extend(true, $.fn.DataTable.TableTools.classes, {
        "container": "DTTT btn-group",
        "buttons": {
            "normal": "btn btn-default",
            "disabled": "disabled"
        },
        "collection": {
            "container": "DTTT_dropdown dropdown-menu",
            "buttons": {
                "normal": "",
                "disabled": "disabled"
            }
        },
        "print": {
            "info": "DTTT_print_info modal"
        },
        "select": {
            "row": "active"
        }
    });
    // Have the collection use a bootstrap compatible dropdown
    $.extend(true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
        "collection": {
            "container": "ul",
            "button": "li",
            "liner": "a"
        }
    });
}

$(document).ready(function() {

    var tableElement = $('#videoTable');

    oTable = tableElement.DataTable({
        "sPaginationType": 'bootstrap',
        "oLanguage": {
            sLengthMenu: '_MENU_ records per page'
        },
        bAutoWidth: false,
        "bServerSide": true,
        "pagingType": "full_numbers",
        "sAjaxSource": "/Login/getVideoGridData/true/getVid",
        "sServerMethod": "POST",
        "aoColumns": [
            {"mDataProp": "vidName"},
            {"mDataProp": "descrip", "bSortable": false},
            {"mDataProp": "id", "bSortable": false}
        ],
        "bDestroy": true,
        fnPreDrawCallback: function() {
            if (!responsiveHelper) {
                responsiveHelper = new ResponsiveDatatablesHelper(tableElement, breakpointDefinition);
            }
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $(nRow).find("td:last").html('<button class="btn btn-primary moveBut" data-toggle="modal" data-target="#videoModal" id="' + aData.id + '">Watch Video!</button>');
            $(nRow).find("td:first").addClass('rowVidName');
            $(nRow).find("td").eq('1').addClass('rowVidDesc');
            $(nRow).find("td:last").find("button").on('click', fnFunc);
            responsiveHelper.createExpandIcon(nRow);
            return nRow;
        },
        fnDrawCallback: function(oSettings) {
            responsiveHelper.respond();
        },
    });

    $('#comSoonDial').dialog({
        autoOpen: false,
        modal: true,
        draggable: false,
        resizable: false,
        title: "Coming Soon!",
        height: 'auto',
        width: '400px',
        fluid: true
    });

    $('.comSoon').on('click', function() {
        $('#comSoonDial').dialog('open');
    });

    $('#videoModal').on('hidden.bs.modal', function() {
        jwplayer('myVideoMedia').stop();
    });

    $("#adminUpdate").submit(function(e) {
        var isDisable = $('input[name="disableVid"]:checked').length > 0;
        if (!isDisable) {
            var jsonData = {
                newVidId: $(this).find("#currentVidId").val(),
                newName: $(this).find("#newName").val(),
                newDescrip: $(this).find("#newDescrip").val()
            };
        } else {
            var jsonData = {
                newVidId: $(this).find("#currentVidId").val(),
                newName: $(this).find("#newName").val(),
                newDescrip: $(this).find("#newDescrip").val(),
                doDisableIt: true
            };
        }
        $.ajax({
            method: "POST",
            url: "/Login/updateVideoGridData/true/getVid",
            data: jsonData,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            success: function(data) {
                if (data.result == true) {
                    $('#videoTitle').html(data.name);
                    $('#videoFooter').html(data.desc);
                    $("#videoTable").find("tr>td>button#" + data.id).parent().parent().find(".rowVidName").html(data.name);
                    $("#videoTable").find("tr>td>button#" + data.id).parent().parent().find(".rowVidDesc").html(data.desc);
                    $('#adminSuccess').html("Successfully updated video name and description").css("color", "green");
                } else {
                    $('#adminSuccess').html("Failed to update video name and description").css("color", "red");
                }
            },
            failure: function(errMsg) {
                alert(errMsg);
            }
        });
        return false;
    });
    var responsiveHelper;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    var fnFunc = function() {
        var vidIdVal = $(this).attr("id");
        var jsonData = {
            vidId: vidIdVal
        };
        $.ajax({
            method: "POST",
            url: "/Login/getVideoGridData/true/getVid",
            data: jsonData,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            success: function(data) {
                $('#videoTitle').html(data.vidName);
                $('#videoFooter').html(data.descrip);
                $('#newName').val(data.vidName);
                $('#newDescrip').val(data.descrip);
                $('#adminSuccess').empty();
                $("#currentVidId").val(vidIdVal);
                $("#disableVid").attr("checked", false);
                $('#videoBody').html('<div id="myVideoMedia">Loading the player...</div>');
                jwplayer("myVideoMedia").setup({file: data.vidPath, width: "100%", aspectratio: "12:5"});
            },
            failure: function(errMsg) {
                alert(errMsg);
            }
        });
    }
});
var loadFooter = function() {
    $('#midTime').show();
};