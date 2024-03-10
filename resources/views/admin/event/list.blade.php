@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0 justify-content-sm-start mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Events</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $breadcrumb }}</a></li>
                </ol>
            </div> 
        </div>
        <div class="row mt-4">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">	
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Venue</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td>{{$event->name}}</td>
                                        <td>{{$event->type}}</td>
                                        <td>{{$event->venue_id}}</td>
                                        <td>
                                            <button type="button" class="btn btn-rounded btn-outline-primary mb-1" onclick="openTableModal('{{$event->name}}', '{{$event->tickets}}')">Show Tickets</button>
                                            <button type="button" class="btn btn-rounded btn-outline-secondary mb-1" onclick="openTableModal('{{$event->name}}', '{{$event->tables}}')">Show Tables</button>
                                            <button type="button" class="btn btn-rounded btn-outline-success mb-1" onclick="openTableModal('{{$event->name}}', '{{$event->guestlists}}')">Show Guestlist</button>
                                            <button type="button" class="btn btn-rounded btn-outline-warning mb-1" onclick="openMediaModal('{{$event->name}}', '{{$event->header_image_path}}', '{{$event->media}}')">Show Media</button>
                                            <button type="button" class="btn btn-rounded btn-outline-info mb-1" onclick="openDetailModal('{{$event}}')">Show More</button>
                                        </td>
                                        <td>
                                            @if($event->status == 'Rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                            @elseif($event->status === 'Pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @else
                                            <span class="badge badge-success">{{$event->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-rounded btn-primary mb-1"><a href="{{ route('admin.events.edit', $event->id) }}"><i class="fa fa-edit"></i></a></button>
                                            <!-- @if(!$event->isApproved())
                                            <button type="button" class="btn btn-rounded btn-danger mb-1" onclick="openDeleteModal('{{$event->id}}')"><i class="fa fa-trash"></i> Delete</button>
                                            @endif -->
                                            <button title="Approve" class="btn btn-rounded btn-success mb-1" onclick="openApproveModal('{{$event->id}}')">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button title="Reject" class="btn btn-rounded btn-danger mb-1" onclick="openRejectModal('{{$event->id}}')">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                            @if($event->feature === "yes")
                                            <button type="button" title="Cancel Feature" class="btn btn-rounded btn-info mb-1">
                                                <a href="{{ route('admin.events.unfeature', $event->id) }}"><i class="fa fa-bitcoin"></i></a>
                                            </button>
                                            @else
                                            <button type="button" title="As Feature" class="btn btn-rounded btn-outline-info mb-1">
                                                <a href="{{ route('admin.events.feature', $event->id) }}"><i class="fa fa-bitcoin"></i></a>
                                            </button>
                                            @endif
                                            @if($breadcrumb == "Featured")
                                            <button type="button" title="Upload Image" class="btn btn-rounded btn-warning mb-1">
                                                <a href="{{ route('admin.events.upload', $event->id) }}"><i class="mdi mdi-image-multiple"></i>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                            <div style="display: flex; justify-content: end; margin-right: 40px;">
                                {{ $events->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Delete Modal -->
<div class="modal fade" id="event_delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color:black">Are you sure you want to delete this event?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info">
                    <a href="$URL">Yes</a>
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Event Table Modal -->
<div class="modal fade" id="modal_event_table">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">$TITLE Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-responsive-am">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="d-none">
                                <td>$Type</td>
                                <td>$Description</td>
                                <td>$Quantity</td>
                                <td>$Price</td>
                                <td>$Approval</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Event Media Modal -->
<div class="modal fade" id="modal_event_media">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="carouselControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../../$HEADERIMAGE" alt="Header Image">
                            <div class="carousel-caption d-none d-md-block"><h5>Header Image</h5></div>
                        </div>
                        <div class="carousel-item image d-none">
                            <img class="d-block w-100" src="../../$PATH" alt="Gallery Image">
                            <div class="carousel-caption d-none d-md-block"><h5>Gallery Image</h5></div>
                        </div>
                        <div class="carousel-item video d-none">
                            <video controls autoplay>
                                <source src="../../$PATH" type="video/mp4">
                            </video>
                            <div class="carousel-caption d-none d-md-block"><h5>Video</h5></div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Detail Modal -->
<div class="modal fade" id="modal_event_detail">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">$TITLE Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5>Description:</h5>
                        <span>$Description<span>
                    </li>
                    <li class="list-group-item">
                        <h5>Facilities:</h5>
                        <span>$Facilities<span>
                    </li>
                    <li class="list-group-item">
                        <h5>Music Policy:</h5>
                        <span>$Music_Policy<span>
                    </li>
                    <li class="list-group-item">
                        <h5>Dress code:</h5>
                        <span>$Dress_code<span>
                    </li>
                    <li class="list-group-item">
                        <h5>Perks:</h5>
                        <span>$Perks<span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Approve Modal -->
<div class="modal fade" id="modal_approve_v2">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color:black">Are you sure you want to approve this event?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info">
                    <a href="$URL">Yes</a>
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="modal_reject_v2">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color:black">Are you sure you want to reject this event?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info">
                    <a href="$URL">Yes</a>
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        const openApproveModal = (event_id) => {
            let url = "{{ route('admin.events.approve', 0) }}";
            url = url.substr(0, url.length-1) + event_id;
            let html = $("#modal_approve_v2").html().replace('$URL', url);
            $("#modal_approve_v2").html(html);
            $("#modal_approve_v2").modal('show');
        }

        const openRejectModal = (event_id) => {
            let url = "{{ route('admin.events.reject', 0) }}";
            url = url.substr(0, url.length-1) + event_id;
            let html = $("#modal_reject_v2").html().replace('$URL', url);
            $("#modal_reject_v2").html(html);
            $("#modal_reject_v2").modal('show');
        }

        const openDeleteModal = (event, event_id) => {
            let url = "{{ route('vendors.event.destroy', 0) }}";
            url = url.substr(0, url.length-1) + event_id;
            let html = $("#event_delete_modal").html().replace("$URL", url);
            $("#event_delete_modal").html(html);
            $("#event_delete_modal").modal('show');
        }

        const openTableModal = (event, tables) => {
            tables = JSON.parse(tables);
            
            const tbody = $("#modal_event_table tbody");
            const sample = tbody.children('.d-none');
            tbody.find('.display').remove();

            tables.forEach(table => {
                const clone = sample.clone().removeClass('d-none').addClass('display');
                let html = clone.html();
                html = html.replace('$Type', table.type)
                html = html.replace('$Description', table.description || '')
                html = html.replace('$Quantity', table.qty)
                html = html.replace('$Price', table.price)
                html = html.replace('$Approval', table.approval)
                tbody.append(clone.html(html));
            });

            const modal = $('#modal_event_table').html().replace('$TITLE', event);
            $('#modal_event_table').html(modal);
            $('#modal_event_table').modal('show');
        }

        const openDetailModal = (event) => {
            event = JSON.parse(event);
            let html = $("#modal_event_detail").html();
            html = html.replace('$Description', event.description || '');
            html = html.replace('$Facilities', event.facilities || '');
            html = html.replace('$Music_Policy', event.music_policy || '');
            html = html.replace('$Dress_code', event.dress_code || '');
            html = html.replace('$Perks', event.perks || '');
            $("#modal_event_detail").html(html);
            $("#modal_event_detail").modal('show');
        }

        const openMediaModal = (venue, headerImage, images) => {
            images = JSON.parse(images);
            
            $(".display-modal").remove();
            const media = $("#modal_event_media").clone().addClass("display-modal");
            const list = media.find('.carousel-inner');
            const html = list.html().replace('$HEADERIMAGE', headerImage);
            list.html(html);
            const videosample = list.children('.video');
            const imagesample = list.children('.image');
            list.find('.display').remove();

            images.forEach(image => {
                if(image.type === 'image')
                {
                    const clone = imagesample.clone().removeClass('d-none').addClass('display');
                    let html = clone.html();
                    html = html.replace('$PATH', image.path);
                    list.append(clone.html(html));
                }
                if(image.type === 'video' || image.type === 'link')
                {
                    const clone = videosample.clone().removeClass('d-none').addClass('display');
                    let html = clone.html();
                    html = html.replace('$PATH', image.path);
                    list.append(clone.html(html));
                }
            });
            media.find('.d-none').remove();
            media.find('.carousel').carousel();
            $("body").append(media);
            media.modal('show');
        }
        window.addEventListener('load', (event) => {
            initDataTable('example', {
                info: false,
                paging: false,
            })
        });
    </script>
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection