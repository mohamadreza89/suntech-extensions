$(document).ready(function() {

    for (var i = 0; i < $('.datetime-pick').length; i++) {
        var id = $('.datetime-pick').eq(i).attr('id');
        $('.datetime-pick').eq(i).attr('data-MdDateTimePicker', 'true');
        $('.datetime-pick').eq(i).attr('data-targetselector', '#' + id);
        $('.datetime-pick').eq(i).attr('data-trigger', 'click');
        $('.datetime-pick').eq(i).attr('data-enabletimepicker', 'true');
    }




    var dateTimePickers = $('[data-MdDateTimePicker="true"]');
    dateTimePickers.each(function() {
        var $this = $(this),
            trigger = $this.attr('data-trigger'),
            placement = $this.attr('data-Placement'),
            enableTimePicker = $this.attr('data-EnableTimePicker'),
            targetSelector = $this.attr('data-TargetSelector'),
            groupId = $this.attr('data-GroupId'),
            toDate = $this.attr('data-ToDate'),
            fromDate = $this.attr('data-FromDate');
        if (!$this.is(':input') && $this.css('cursor') == 'auto')
            $this.css({
                cursor: 'pointer'
            });
        $this.MdPersianDateTimePicker({
            Placement: placement,
            Trigger: trigger,
            EnableTimePicker: enableTimePicker != undefined ? enableTimePicker : false,
            TargetSelector: targetSelector != undefined ? targetSelector : '',
            GroupId: groupId != undefined ? groupId : '',
            ToDate: toDate != undefined ? toDate : '',
            FromDate: fromDate != undefined ? fromDate : '',
        });
    });
});