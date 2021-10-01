// Cart Event GLobal Broadcast Listner 
var CartEventChannel = Echo.channel(`CartEvent.Session.${$('meta[name=session-id]').attr('content')}`);

if ($('meta[name=user-id]').length) {
    CartEventChannel = Echo.private(`CartEvent.User.${$('meta[name=user-id]').attr('content')}`)
}

CartEventChannel.listen('CartEvent', (e) => cartEvent(e.data)); 



