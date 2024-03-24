@if (session()->has('success'))
    <div class="notification-top {{ uniqid() }}">
        <div class="alert alert-success d-flex justify-content-between">
            <div>
                {{ session('success') }}
            </div>
            <div> 
                <a class="text-success" href="#" onclick="document.querySelector('.notification-top').remove()">
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
