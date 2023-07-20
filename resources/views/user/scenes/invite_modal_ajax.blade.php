 <!-- Modal -->
 <div class="modal fade" id="exampleModal-people" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             <input type="hidden" value="{{ $scene->id }}" id="modal-scene-id">

             <ul class="nav nav-tabs" role="tablist">
                 @if (auth()->user()->id == $scene->user_id)
                     <li class="nav-item">
                         <a class="nav-link active" data-toggle="tab" href="#invited-tabs-1" role="tab">Invite
                             People</a>
                     </li>
                 @endif
                 <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#invited-tabs-2" role="tab">Invited
                         People</a>
                 </li>
             </ul><!-- Tab panes -->
             <div class="tab-content">
                 @if (auth()->user()->id == $scene->user_id)
                     <div class="tab-pane active " id="invited-tabs-1" role="tabpanel">
                         <div class="title-flex">
                             <img width="80" height="80"
                                 src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                                 alt="image" class="img-fluid">

                             <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"
                                     aria-hidden="true"></i> Invite People</h5>
                         </div>
                         <br>
                         <div class="add-people-search-box input-group">
                             <input type="text" placeholder="Enter email" id="add-people-input" class="form-control">
                             <div class="input-group-append">
                                 <button id="add-people-button" class="btn btn-primary">Add</button>
                             </div>
                             <div id="search-result"></div> <!-- to display search results -->

                         </div>
                         <div id="error-message-container"></div>


                         {{-- <div class="add-people-search-box">
                         <input type="text" placeholder="Add people email and press enter"
                             id="add-people-input" class="form-control">
                         <button id="add-people-button" class="btn btn-primary">Add</button>

                         <div id="search-result"></div> <!-- to display search results -->

                     </div> --}}

                         <div class="add-people-div scrollbar" id="style-3">
                             <div class="add-people-flex">
                                 <div class="add-link-func">
                                     <img width="35"
                                         src="{{ auth()->user()->profile_image->avatar ??Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(112, 112)->setShape('circle')->setBackground('#' . substr(md5(rand()), 0, 6)) }}"alt="image"
                                         class="img-fluid">
                                     <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                                 </div>
                                 <div class="add-position-box">
                                     <span>Owner</span>
                                 </div>
                             </div>
                         </div>

                         <div class="add-people-search-box">
                             <textarea cols="6" rows="3" id="invite-message" placeholder="Add message (optional)" class="form-control"></textarea>
                         </div>
                         <br>
                         <div class="btn-design">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                             <button type="button" class="btn btn-primary" id="invite-people" disabled>Invite
                                 People</button>
                         </div>
                     </div>
                 @endif
                 <div class="tab-pane {{ auth()->user()->id !== $scene->user_id ? 'active' : '' }}" id="invited-tabs-2"
                     role="tabpanel">
                     <div class="modal-header">
                         <img width="80" height="80"
                             src="{{ $scene->scene_canvas_image?->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot' }}"
                             alt="image" class="img-fluid">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users" aria-hidden="true"></i>
                             Invited people</h5>

                     </div>
                     <div class="modal-body">
                         <div class="scrollbar" id="style-3">
                             <div class="invite-people-box">
                                 <div class="invite-profile">
                                     <img width="35"
                                         src="{{ auth()->user()->profile_image->avatar ??Avatar::create(auth()->user()->first_name . ' ' . auth()->user()->last_name)->setDimension(112, 112)->setShape('circle')->setBackground('#' . substr(md5(rand()), 0, 6)) }}"alt="image"
                                         class="img-fluid">
                                     <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                                 </div>
                                 <div class="profile-member">
                                     <span>You</span>
                                 </div>
                             </div>
                             @forelse($invitedUsersList as $user)
                                 <div class="invite-people-box">
                                     <div class="invite-profile">
                                         <img src="{{ Avatar::create(strtoupper($user->email))->setDimension(112, 112)->setBackground('#' . substr(md5(rand()), 0, 6)) }}"
                                             alt="image" class="img-fluid">
                                         <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                     </div>
                                     <div class="profile-member">
                                         <span>{{ $user->is_accepted ? 'Accepted' : 'Pending' }}</span>
                                     </div>
                                 </div>
                             @empty
                                 <p>You have not invited yet.</p>
                             @endforelse

                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </div>
 <!-- Modal -->
