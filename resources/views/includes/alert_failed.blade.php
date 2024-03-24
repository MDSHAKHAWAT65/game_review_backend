@if (session()->has('failed'))
    <div class="notification-top {{ uniqid() }}">
        <div class="alert alert-danger d-flex justify-content-between">
            <div>
                {{ session('failed') }}
            </div>
            <div> 
                <a class="text-danger" href="#" onclick="document.querySelector('.notification-top').remove()">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            let notification = document.querySelector('.notification-top');
            if(notification) notification.remove();
        }, 9000);
    </script>
@endif
