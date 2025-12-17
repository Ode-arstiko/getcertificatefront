@if (session('certificateOnProcess'))
    <div class="alert alert-success" role="alert">
        {{ session('certificateOnProcess') }}
    </div>
@endif
@if (session('httpError'))
    <div class="alert alert-danger" role="alert">
        {{ session('httpError') }}
    </div>
@endif


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Template</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <table class="table table-head-fixed text-nowrap">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No.</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Template Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['template'] as $temp)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">
                                        {{ strlen($temp['template_name']) > 60 ? substr($temp['template_name'], 0, 60) . '...' : $temp['template_name'] }}
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="/certificates/create/{{ encrypt($temp['id']) }}"
                                        class="btn btn-primary mb-0 shadow"><i class="fas fa-paper-plane mr-2"></i>Select</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="p-3">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fas fa-plus mr-2"></i>Make Certificate
    </button>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Certificate Zips</h3>

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
                            <h6 class="fw-semibold mb-0">Zip Name</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Created At</h6>
                        </th>
                        <th colspan="3" class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['zips'] as $zip)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">
                                    {{ strlen($zip['zip_name']) > 30 ? substr($zip['zip_name'], 0, 30) . '...' : $zip['zip_name'] }}
                                </h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ substr($zip['created_at'], 0, 10) }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <a href="{{ route('certificates.detail', $zip['id']) }}"
                                    class="btn btn-primary mb-0 shadow">
                                    <i class="ti ti-pencil me-2"></i>Details
                                </a>
                            </td>
                            <td class="border-bottom-0">
                                <form action="/certificates/delete/{{ encrypt($zip['id']) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit"><i
                                            class="ti ti-trash me-2"></i>Delete</button>
                                </form>
                            </td>
                            <td class="border-bottom-0">
                                <a href="{{ route('certificates.download.zip', $zip['id']) }}"
                                    class="btn btn-success mb-0 shadow">
                                    <i class="ti ti-download me-2"></i>Download Zip
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>