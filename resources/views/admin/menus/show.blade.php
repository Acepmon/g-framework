@extends('themes.limitless.layouts.default')

@section('title', 'Details')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/effects.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/trees/fancytree_all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/trees/fancytree_childcounter.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.menus.includes.pageheader', ['breadcrumb' => 'menus_show'])
@endsection

@section('content')

<!-- Grid -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Horizontal form</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Type</label>
                        <div class="col-lg-10">
                            {{$menu->type}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Title</label>
                        <div class="col-lg-10">
                            {{$menu->title}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Link</label>
                        <div class="col-lg-10">
                            {{$menu->link}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Icon</label>
                        <div class="col-lg-10">
                            {{$menu->icon}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Parent ID</label>
                        <div class="col-lg-10">
                            @if(!empty($menu->parent_id))
                            {{$menu->parent->name}}
                            @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <a type="button" href="javascript:history.back()" class="btn btn-light" ><i class="icon-arrow-left13 ml-2"></i> Back</a>

                        <!-- <a type="submit" class="btn btn-danger">Delete form </i></a> -->
                        <a type="button" href="{{ route('admin.menus.edit', ['id' => $menu->id]) }}" class="btn btn-primary">Edit</i> <i class="icon-arrow-right14 ml-2"></i> </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                    <div style="display: none">{{$i=1}}</div>
                        @foreach($menu->groups as $data)
                        <tr>
                            <td>{{ $data->id}}</td>
                            <td>{{ $data->title}}</td>
                            <td>{{ $data->description}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h6 class="card-title">Submenus</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-condensed tree-table">
            <thead>
                <tr>
                    <th style="width: 80px;">#</th>
                    <th>Title</th>
                    <th style="width: 100px;">Link</th>
                    <th style="width: 50px;">Group</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    window.delete_confirm = function(id) {
        $("#delete_form").attr('action', '/admin/menus/'+id);
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
            checkbox: true,
            table: {
                indentation: 20,      // indent 20px per node level
                nodeColumnIdx: 1,     // render the node title into the 2nd column
                checkboxColumnIdx: 0  // render the checkboxes into the 1st column
            },
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
                url: "/admin/menus/tree?parent_id={{$menu->id}}"

            },
            lazyLoad: function(event, data) {
                data.result = {url: "ajax-sub2.json"}
            },
            renderColumns: function(event, data) {
                var node = data.node;

                console.log(node);

                $tdList = $(node.tr).find(">td");

                $tdList.eq(0).text(node.getIndexHier()).addClass("alignRight");

                $tdList.eq(2).addClass('text-left').html("<a href='" + node.data.link + "' style='display: block;max-width: 150px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>" + node.data.link + "</a>");
                $tdList.eq(3).addClass('text-left').html("<span class='label label-default label-striped'>" + node.data.group + "</a>");
                $tdList.eq(4).addClass('text-center').html(`
                    <div class='btn-group'>
                    <a href='/admin/menus/` + node.data.id + `' class='btn btn-light btn-xs'><span class='icon-eye'></span></a>
                    <a href='/admin/menus/` + node.data.id + `/edit' class='btn btn-light btn-xs'><span class='icon-pencil'></span></a>
                    <a href='#' data-toggle='modal' data-target='#modal_theme_danger' onclick='delete_confirm(` + node.data.id + `)' class='btn btn-light btn-xs'><span class='icon-trash'></span></a>
                    </div>`);

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
    });
</script>
@endsection
