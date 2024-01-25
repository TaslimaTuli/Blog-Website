
 <header class="header">
     <nav class="navbar navbar-expand-lg">
         <div class="search-panel">
             <div class="search-inner d-flex align-items-center justify-content-center">
                 <div class="close-btn">Close <i class="fa fa-close"></i></div>
                 <form id="searchForm" action="#">
                     <div class="form-group">
                         <input type="search" name="search" placeholder="What are you searching for...">
                         <button type="submit" class="submit">Search</button>
                     </div>
                 </form>
             </div>
         </div>
         <div class="container-fluid d-flex align-items-center justify-content-between">
             <div class="navbar-header">
                 <!-- Navbar Header--><a href="/" class="navbar-brand">
                     <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">
                             Neko
                         </strong>

                     </div>
                     <div> Hello {{ Auth::user()->name }} </div>
             </div>
             {{-- search --}}
             <div class="list-inline-item logout">
                 {{-- <div class="list-inline-item">
                    <a href="{{ url('search') }}" class="search-open nav-link"><i
                             class="icon-magnifying-glass-browser"></i></a>

                 </div> --}}

                 <div class="list-inline-item dropdown">
                     <a id="navbarDropdownMenuLink2" href="http://example.com" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false" class="nav-link tasks-toggle">
                         <i class="icon icon-email"></i>
                         <span class="badge dashbg-3" id="newPostBadge"></span>
                     </a>
                      <!-- Section for Pending Tasks -->
                     <div aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu tasks-list" id="tasksDropdown">
                         <div  class="dropdown-header">Pending Tasks</div>
                         <div id="pendingTasksSection">
                             <!-- Pending task items will be appended here -->
                         </div>

                         <a href="{{ url('pending_post') }}" class="dropdown-item text-center">
                             <strong>See All Pending Posts <i class="fa fa-angle-right"></i></strong>
                         </a>
                     </div>
                 </div>

                 <!-- Log out  -->
                 <div class="list-inline-item logout">
                     <x-responsive-nav-link :href="route('profile.edit')">
                         {{-- <p> {{ __('Profile') }} </p> --}}
                         <i class="icon-user-outline"></i>
                     </x-responsive-nav-link>
                 </div>

                 <div class="list-inline-item logout">
                     <form method="POST" action="{{ route('logout') }}">
                         @csrf

                         <x-responsive-nav-link :href="route('logout')"
                             onclick="event.preventDefault();
                            this.closest('form').submit();">
                             {{-- <p>
                                 {{ __('Log Out') }} </p> --}}
                                 <i class="icon-logout"></i>
                         </x-responsive-nav-link>
                     </form>
                 </div>
             </div>
         </div>
     </nav>
 </header>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateDropdownContent() {
        // Update new post badge
        $.ajax({
            url: '/get-new-post-count',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#newPostBadge').text(response.count);
            },
            error: function() {
                console.error('Error fetching new post count');
            }
        });

        // Update pending tasks
        $.ajax({
            url: '/get-pending-tasks',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Clear previous pending tasks
                $('#pendingTasksSection').empty();

                // Append pending tasks
                response.tasks.forEach(function(task) {
                    $('#pendingTasksSection').append('<a href="{{ url('pending_post') }}" class="dropdown-item">' + task.title + '</a>');
                });
            },
            error: function() {
                console.error('Error fetching pending tasks');
            }
        });
    }
    updateDropdownContent();
    setInterval(updateDropdownContent, 60000); // Update every 60 seconds
</script>
