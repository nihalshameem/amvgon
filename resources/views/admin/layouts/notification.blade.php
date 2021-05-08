@foreach (auth()->user()->unreadNotifications as $notification)
    <a class="dropdown-item n-single new" href="javascript:void(0);" onclick="reader(this)"
        data-orderid="{{ $notification->data['id'] }}" data-id="{{ $notification->id }}">
        <div class="item-content">
            <h6 class="font-weight-normal">{{ $notification->data['head'] }}</h6>
            <p class="font-weight-light small-text mb-0 text-muted">
                {{ date('j F, Y', strtotime($notification->data['date'])) }}
            </p>
        </div>
    </a>
@endforeach
@if (auth()
        ->user()
        ->unreadNotifications->count() == 0)
    <i>no notifications</i>
@else
    <p class="read-all" onclick="readall()">mark as all read</p>
@endif
<script>
    if ($("#noti-drop a").hasClass("new") == false) {
        $("#notificationDropdown span").remove();

    } else {
        $("#notificationDropdown i").append('<span class="count"></span>');
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        } else {
            if (("Notification" in window)) {
                notification.close();
            }
            let getUrl = window.location;
            let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            var notification = new Notification('Notification', {
                icon: $('.brand-logo img').attr('src'),
                body: 'Click to view notification',
            });
            notification.onclick = function() {
                $('#notificationDropdown').click();
                notification.close();
            };
        }
    }

</script>
