                <div class="account-nav">
                    <ul class="account-list">
                        <li class="mb-25"><a href="{{ route('user.index') }}" class="items">DASHBOARD</a></li>
                        <li class="mb-25"><a href="{{ route('user.orders') }}" class="items">ORDERS</a></li>
                        <li class="mb-25"><a href="" class="items">ADDRESSES</a></li>
                        <li class="mb-25"><a href="{{ route('user.user.details') }}" class="items">ACCOUNT DETAILS</a></li>
                        <li class="mb-25">
                            <form action="{{ route('logout') }}" id="logout" method="POST">
                                @csrf
                                <a class="items"
                                    onclick="event.preventDefault();document.getElementById('logout').submit();">LOGOUT</a>
                            </form>
                        </li>
                    </ul>
                </div>