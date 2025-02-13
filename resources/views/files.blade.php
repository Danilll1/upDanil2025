@extends('layouts.layout')

@section('content')

    <div class="list-container">
        <div class="files-title">
            <h1>Файлы</h1>
            <i class="fa-solid fa-file"></i>

        </div>


        @if ($folders->isNotEmpty())
            <div class="folder-container">
                <div class="folder-create">
                    <div class="dropdown-button createFolderBtn createTaskBtn">
                        <ul class="dropdown">
                            <div class="dropdown-title">
                                <i class="fa-solid fa-folder-plus"
                                    style="color: #000000; font-size: 19px; margin-top: 3px;"></i>
                            </div>
                            <div class="dropdown-items">
                                <form action="{{route('folder.store')}}" method="POST">
                                    @csrf
                                    <li>
                                        <input type="text" class="form-control inputEdit" name="foldersName"
                                            placeholder="Название" autocomplete="off">
                                    </li>
                                    <li>
                                        <button type="submit" class="btnnav"><i class="fa-solid fa-check"
                                                style="position: relative; bottom: 2px;"></i></button>
                                    </li>
                                </form>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="folder-items">
                <h2>Папки</h2>
    @foreach ($folders as $folder)
        <div class="folder-item">
            <div class="folder">
            <div class="dropdown-button dropdown-folder-btn">
                <ul class="dropdown dropdown-folder">
                    <div class="dropdown-title">
                        <div class="folder-add">
                            <form action="{{ route('folder.add') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <label class="upload-to-folder" for="file-to-folder-input-{{ $folder->id }}">
                                    <i class="fa-solid fa-file-circle-plus" style="color: #000000;"></i>
                                </label>
                                <input type="hidden" name="folderId" value="{{ $folder->id }}">
                                <input type="file" name="file" id="file-to-folder-input-{{ $folder->id }}" 
                                       class="form-control file-to-folder-input" placeholder='Добавить файл в папку'>
                                <button type="submit" class="btnnav">
                                    <i class="fa-solid fa-check" style="position: relative; bottom: 2px;"></i>
                                </button>
                            </form>
                        </div>
                        
                        <a href="#" class="ifolder"><i class="fa-solid fa-folder"></i><i class="fa-solid fa-folder-open"></i> {{ $folder->name }}</a>
                    </div>
                    <div class="dropdown-items">
                        <div class="divider-folder"></div>
                        
                            @foreach ($files as $file)
                            <li>
                                @if ($file->folder_id == $folder->id)
                                
                                    <div class="file-item">
                                        <a href="{{ asset('storage/' . $file->path) }}"><i class="fa-solid fa-file-alt"></i>
                                            {{ $file->name }}</a>
                                        <div class="file-actions">
                                            <form action="{{ route('destroy.file', $file->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnnav"><i class="fa-solid fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            @endforeach
                        
                    </div>
                </ul>
            </div>
            </div>

        </div>
    @endforeach
</div>

        @endif


            <div class="files-cycle">

                <div class="files-container">
                    <div class="files-input">
                        <form class="files-input-form" action="{{route('store')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="file" class="form-control" name="file" id="file" placeholder="Выберите файл">
                            <button type="submit" class="btnnav">Сохранить</button>
                        </form>
                    </div>
                </div>

                <div class="file-items">
                    @if (!empty($files) && $files->isNotEmpty())
                        @foreach ($files as $file)
                            <div class="file-item">
                                <a href="{{ asset('storage/' . $file->path) }}"><i class="fa-solid fa-file-alt"></i>
                                    {{ $file->name }}</a>
                                <div class="file-actions">
                                    <!-- <a href="{{ route('edit', $file->id) }}"><i class="fa-solid fa-pencil-alt"></i></a> -->
                                    <form action="{{ route('destroy.file', $file->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btnnav"><i class="fa-solid fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h6>Файлов не обнаружено</h6>
                    @endif
                </div>

            </div>




        </div>
    </div>

@endsection