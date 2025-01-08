<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

</head>
<body>
    <div class="page-heading">
        <div class="page-title">
            <h3>{{$data['page_name']}}</h3>
            <p class="text-subtitle text-muted">{{$data['page_subname']}}</p>
        </div>
    <div class="search-bar">
        <form class="d-flex align-items-center" style="width: 100%; position: relative;">
            <span class="search-icon">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Cari sesuatu..." aria-label="Search">
            <button class="btn btn-primary ms-2" type="submit">Search</button>
        </form>
    </div>
        <div class="avatar">
            <img src="{{ auth()->user()->user_image != '-' ? asset('storage/' . auth()->user()->user_image) : asset('/') . 'assets/compiled/jpg/5.jpg' }}" alt="Avatar">
            <div class="ms-2 name">
                <p class="font-bold py-0 my-0">{{ auth()->user()->name }}</p>
                <small class="text-muted mb-0">{{ auth()->user()->role }}</small>
            </div>
        </div>
    </div>

    <div style="margin-top: 10px; padding: 20px;">
        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>