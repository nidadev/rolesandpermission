@if(Session::has('success'))
                    {{ Session::get('success')}}
                    @endif

                    @if(Session::has('error'))
                    {{ Session::get('error')}}
                    @endif