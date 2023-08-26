<x-header />

<body class="p-2">
    <div class="container">
        <div class="p-2">
            <table class="table table-striped">
                <thead>
                    <th class="bg-dark text-white">No KP</th>
                    <th class="bg-dark text-white">Nama</th>
                    <th class="bg-dark text-white">Password</th>

                </thead>
                <tbody>
                    @foreach($senaraiPanel as $per_panel)::
                    @object($per_panel):;
                    <tr>
                        <td>{{$per_panel->nokp}}</td>
                        <td>{{$per_panel->nama}}</td>
                        <td>{{$per_panel->password}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>