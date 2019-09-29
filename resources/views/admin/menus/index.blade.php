@extends('themes.limitless.layouts.default')

@section('title', 'All Menus')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/effects.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/trees/fancytree_all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/trees/fancytree_childcounter.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.menus.includes.pageheader', ['breadcrumb' => 'menus_index'])
@endsection

@section('content')

<!-- Table tree -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Menus</h6>

        <div class="header-elements">
            <a href="#modal_menu_new" data-toggle="modal" class="btn btn-primary"><span class="icon-plus3 position-left"></span> New Menu</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-condensed table-bordered tree-table">
            <thead>
                <tr>
                    <th style="width: 30px;">#</th>
                    <th>Title</th>
                    <th style="width: 40px;">Link</th>
                    <th style="width: 40px;">Module</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!-- /table tree -->

<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Delete?</h6>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this record?</p>
            </div>

            <div class="modal-footer">
                <form method="post" id="delete_form" action="/admin/menus/0">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_menu_edit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Edit Menu</h6>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('admin.menus.store') }}" id="menu_edit_form">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Menu title" value="{{ old('title') }}" required autocomplete="title">
                    </div>

                    <div class="form-group">
                        <label for="link" class="control-label">Link</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="https://..." value="{{ old('link') }}" autocomplete="link">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_page">Choose From Pages</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icon" class="control-label">Icon</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" placeholder="Menu icon" value="{{ old('icon') }}" autocomplete="icon">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_icon">Choose Icon</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="module" class="control-label">Module</label>
                        <input type="text" class="form-control @error('module') is-invalid @enderror typeahead-module" name="module" placeholder="Menu group" value="{{ old('group') }}" autocomplete="group">
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-loading" data-loading-text="<i class='icon-spinner4 spinner position-left'></i> Saving">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_menu_add_submenu" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Add Sub Menu</h6>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('admin.menus.store') }}" id="menu_add_submenu_form">
                    @csrf

                    <fieldset class="content-group">
                        <legend class="text-bold">Parent Menu</legend>
                        <input type="text" name="parent_id" hidden>

                        <div class="media" style="margin-top: 0px;" id="menu_add_submenu_form_parent">
                            <span class="icon-spinner4 spinner"></span>
                        </div>
                    </fieldset>

                    <fieldset class="content-group">
                        <legend class="text-bold">Sub Menu</legend>

                        <div class="form-group">
                            <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Menu title" value="{{ old('title') }}" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="link" class="control-label">Link</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="https://..." value="{{ old('link') }}" autocomplete="link">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_page">Choose From Pages</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icon" class="control-label">Icon</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" placeholder="Menu icon" value="{{ old('icon') }}" autocomplete="icon">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_icon">Choose Icon</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="module" class="control-label">Module</label>
                            <input type="text" class="form-control @error('module') is-invalid @enderror typeahead-module" name="module" placeholder="Menu module" value="{{ old('module') }}" autocomplete="module">
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-loading" data-loading-text="<i class='icon-spinner4 spinner position-left'></i> Saving">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_menu_new" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">New Menu</h6>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('admin.menus.store') }}" id="menu_new_form">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Menu title" value="{{ old('title') }}" required autocomplete="title">
                    </div>

                    <div class="form-group">
                        <label for="link" class="control-label">Link</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="https://..." value="{{ old('link') }}" autocomplete="link">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_page">Choose From Pages</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icon" class="control-label">Icon</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" placeholder="Menu icon" value="{{ old('icon') }}" autocomplete="icon">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_icon">Choose Icon</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="module" class="control-label">Module</label>
                        <input type="text" class="form-control @error('module') is-invalid @enderror typeahead-module" name="module" placeholder="Menu module" value="{{ old('module') }}" autocomplete="module">
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-loading" data-loading-text="<i class='icon-spinner4 spinner position-left'></i> Saving">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_choose_page" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Choose from Pages</h6>
            </div>

            <div class="modal-body">
                <ul class="media-list media-list-bordered">
                    @foreach ($pages as $index => $page)
                    <li class="media">
                        <div class="media-left">
                            <h5 class="text-center">{{ $index + 1 }}</h5>
                        </div>

                        <div class="media-body">
                            <h6 class="media-heading">{{ $page->title }}</h6>
                            <small><a href="{{ url($page->slug) }}" target="_blank">{{ url($page->slug) }}</a></small>
                        </div>

                        <div class="media-right">
                            <button type="button" class="btn btn-light" onclick="choosePage('{{ url($page->slug) }}')">Choose</button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="modal_choose_icon" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Icomoon icon set</h6>
            </div>

            <div class="modal-body">
                <p class="content-group">Icomoon is a custom icon set, includes 1145 icon glyphs based on 16px grid. This set is a <code>default</code> icon set of the template, majority of components are using Icomoon font family for UI elements instead of images, so all of them are retina-ready. <code>Glyphicon</code> and <code>FontAwesome</code> icon sets are also added, but as optional choice. In order to get the best look of UI elements, I recommend to include this icon set only as you can find perfectly crafted icons according to most of your common needs.</p>

                <div class="row glyphs">
                    @foreach ($icons as $icon)
                    <div class="col-md-3 col-sm-4" onclick="chooseIcon('{{$icon}}')"><i class="{{$icon}}"></i> {{$icon}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function delete_confirm(id) {
        $("#delete_form").attr('action', '/admin/menus/'+id);
    }

    function menu_edit(id) {
        $("#menu_edit_form").attr('action', '/admin/menus/'+id);

        $.getJSON('{{ route('admin.menus.index') }}/'+id, function (data) {
            var title = data.title;
            var link = data.link;
            var icon = data.icon;
            var module = data.module;

            $("#menu_edit_form").find('[name="title"]').val(title);
            $("#menu_edit_form").find('[name="link"]').val(link);
            $("#menu_edit_form").find('[name="icon"]').val(icon);
            $("#menu_edit_form").find('[name="module"]').val(module);
        });
    }

    function menu_add_submenu(id) {
        $("#menu_add_submenu_form").find('[name="parent_id"]').val(id);
        var parentMedia = $("#menu_add_submenu_form_parent");

        parentMedia.html('<span class="icon-spinner4 spinner"></span>');

        $.getJSON('{{ route('admin.menus.index') }}/'+id, function (data) {
            var icon = data.icon;
            var title = data.title;
            var link = data.link;
            var module = data.module;

            parentMedia.html('');

            if (icon && icon.length) {
                parentMedia.append('<div class="media-left"><span class="'+icon+'"></span></div>');
            }

            if (title && title.length) {
                var bodyStr = '<div class="media-body"><h6 class="media-heading">'+title+'</h6>';
                if (link && link.length) {
                    bodyStr = bodyStr + '<small><a href="'+link+'">'+link+'</a></small>';
                }
                bodyStr = bodyStr + '</div>';
                parentMedia.append(bodyStr);
            }

            if (module && module.length) {
                parentMedia.append('<div class="media-right"><span class="badge badge-light badge-striped">'+module+'</span></div>');
            }
        });
    }

    function choosePage(url) {
        $('[name="link"]').val(url);

        $('#modal_choose_page').modal('hide');
    }

    function chooseIcon(icon) {
        $('[name="icon"]').val(icon);

        $('#modal_choose_icon').modal('hide');
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //
        // Table tree
        //

        $(".tree-table").fancytree({
            extensions: ["table", "dnd"],
            checkbox: false,
            table: {
                indentation: 20,      // indent 20px per node level
                nodeColumnIdx: 1,     // render the node title into the 2nd column
            },
            icon: false,
            dnd: {
                autoExpandMS: 500,
                focusOnClick: true,
                preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
                preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
                dragStart: function(node, data) {
                    return true;
                },
                dragEnter: function(node, data) {
                    return ["before", "after"];
                },
                dragDrop: function(node, data) {
                    var change = {
                        mode: data.hitMode,
                        other: data.node.data.id,
                        node: data.otherNode.data.id
                    }

                    $.ajax({
                        type: 'PUT',
                        url: '{{ route('admin.menus.tree.update') }}',
                        data: change,
                        success: function () {
                            // This function MUST be defined to enable dropping of items on the tree.
                            data.otherNode.moveTo(node, data.hitMode);
                        }
                    });
                }
            },
            source: {
                url: "/admin/menus/tree"
            },
            lazyLoad: function(event, data) {
                data.result = {url: "/admin/menus/tree"}
            },
            renderColumns: function(event, data) {
                var node = data.node;

                $tdList = $(node.tr).find(">td");

                // (index #0 is rendered by fancytree by adding the checkbox)
                $tdList.eq(0).text(node.getIndexHier()).addClass("alignRight");

                $tdList.eq(2).addClass('text-left').html(node.data.link ? "<a href='" + node.data.link + "' style='display: block;max-width: 150px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>" + node.data.link + "</a>" : "");
                $tdList.eq(3).addClass('text-left').html(node.data.module ? "<span class='badge badge-light badge-striped'>" + node.data.module + "</a>" : "");
                $tdList.eq(4).addClass('text-center').html(`
                    <div class='btn-group'>
                    <a href='#modal_menu_edit' data-toggle="modal" onclick='menu_edit(` + node.data.id + `)' class='btn btn-light btn-sm'><span class='icon-pencil'></span></a>
                    <a href='#modal_theme_danger' data-toggle='modal' onclick='delete_confirm(` + node.data.id + `)' class='btn btn-light btn-sm'><span class='icon-trash'></span></a>
                    </div>

                    <a href='#modal_menu_add_submenu' data-toggle="modal" onclick='menu_add_submenu(` + node.data.id + `)' class='btn btn-light btn-sm'><span class='icon-plus-circle2'></span></a>
                `);

                // Style checkboxes
                $(".styled").uniform({radioClass: 'choice'});
            }
        });

        // Handle custom checkbox clicks
        $(".tree-table").delegate("input[name=like]", "click", function (e){
            var node = $.ui.fancytree.getNode(e),
            $input = $(e.target);
            e.stopPropagation(); // prevent fancytree activate for this row
            if($input.is(":checked")){
                alert("like " + $input.val());
            }
            else{
                alert("dislike " + $input.val());
            }
        });

        $("#menu_new_form").submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            var btn = $(this).find('[type="submit"]');
            btn.button('loading');

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function (data) {
                    form.trigger('reset');
                    btn.button('reset');

                    $('#modal_menu_new').modal('hide');

                    var tree = $('.tree-table').fancytree('getTree');
                    tree.reload();
                }
            })
        });

        $("#menu_add_submenu_form").submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            var btn = $(this).find('[type="submit"]');
            btn.button('loading');

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function (data) {
                    form.trigger('reset');
                    btn.button('reset');

                    $('#modal_menu_add_submenu').modal('hide');

                    var tree = $('.tree-table').fancytree('getTree');
                    tree.reload();
                }
            })
        });

        $("#menu_edit_form").submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            var btn = $(this).find('[type="submit"]');
            btn.button('loading');

            $.ajax({
                url: url,
                type: 'PUT',
                data: form.serialize(),
                success: function (data) {
                    form.trigger('reset');
                    btn.button('reset');

                    $('#modal_menu_edit').modal('hide');

                    var tree = $('.tree-table').fancytree('getTree');
                    tree.reload();
                }
            })
        });

        // Basic example
        // ------------------------------

        // Substring matches
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {

                        // the typeahead jQuery plugin expects suggestions to a
                        // JavaScript object, refer to typeahead docs for more info
                        matches.push({ value: str });
                    }
                });

                cb(matches);
            };
        };

        // Add data
        var modulesJson = '{!! json_encode($modulesArray) !!}';
        var modules = JSON.parse(modulesJson);

        // Initialize
        $('.typeahead-module').typeahead(
            {
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'modules',
                displayKey: 'value',
                source: substringMatcher(modules)
            }
        );
    });
</script>
@endsection
