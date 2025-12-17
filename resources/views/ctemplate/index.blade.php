<div class="p-3">
    <a href="/ctemplates/create" class="btn btn-primary shadow mt-3 mb-3"><i class="fas fa-plus mr-2"></i> Make
        Template</a>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Certificate Templates</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No.</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Template Name</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Created At</h6>
                        </th>
                        <th colspan="2" class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ctemplate as $tmp)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">
                                    {{ strlen($tmp['template_name']) > 60 ? substr($tmp['template_name'], 0, 60) . '...' : $tmp['template_name'] }}
                                </h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ substr($tmp['created_at'], 0, 10) }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <a href="/ctemplates/edit/{{ encrypt($tmp['id']) }}"
                                    class="btn btn-primary mb-0 shadow"><i class="fas fa-pen mr-2"></i>Edit</a>
                            </td>
                            <td class="border-bottom-0">
                                <form action="/ctemplates/delete/{{ encrypt($tmp['id']) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-0 shadow"><i
                                            class="fas fa-trash mr-2"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>