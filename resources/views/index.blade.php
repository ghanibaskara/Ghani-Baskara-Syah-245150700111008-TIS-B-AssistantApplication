<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant Application Client</title>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.14.0/dist/axios.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        h2 {
            border-bottom: 1px solid;
            padding-bottom: 8px;
            margin-top: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .section {
            border: 1px solid;
            padding: 20px;
            margin-bottom: 20px;
        }

        .method-label {
            font-size: 12px;
            font-weight: bold;
            margin-left: 8px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }

        .id-row {
            display: flex;
            gap: 8px;
            align-items: flex-end;
        }

        .id-row input {
            flex: 1;
        }

        .two-col {
            display: flex;
            gap: 20px;
        }

        .two-col > div {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid;
            text-align: left;
            font-size: 14px;
        }

        .empty-msg {
            text-align: center;
            padding: 20px;
        }

        .response-box {
            margin-top: 15px;
            padding: 12px;
            font-family: Consolas, 'Courier New', monospace;
            font-size: 13px;
            white-space: pre-wrap;
            word-break: break-word;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid;
        }

        @media (max-width: 768px) {
            .two-col {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Assistant Application Client</h1>
    <p class="subtitle">Manajemen Pendaftaran Asisten Dosen</p>

    <div class="section">
        <h2>Daftar Semua Pendaftar <span class="method-label">[GET]</span></h2>
        <button class="btn" id="btn-get" onclick="getAllApplications()">Ambil Semua Data</button>
        <div id="table-wrapper">
            <p class="empty-msg">Klik tombol di atas untuk memuat data.</p>
        </div>
        <div id="response-get"></div>
    </div>

    <div class="two-col">
        <div class="section">
            <h2>Tambah Pendaftar <span class="method-label">[POST]</span></h2>
            <form id="form-post" onsubmit="createApplication(event)">
                <div class="form-group">
                    <label for="post-student-name">Nama Mahasiswa</label>
                    <input type="text" id="post-student-name" placeholder="contoh: Budi Santoso" required>
                </div>
                <div class="form-group">
                    <label for="post-student-id">NIM</label>
                    <input type="text" id="post-student-id" placeholder="contoh: 245150700111008" required>
                </div>
                <div class="form-group">
                    <label for="post-course-name">Mata Kuliah</label>
                    <input type="text" id="post-course-name" placeholder="contoh: Pemrograman Web" required>
                </div>
                <div class="form-group">
                    <label for="post-gpa">IPK</label>
                    <input type="number" id="post-gpa" step="0.01" min="0" max="4" placeholder="contoh: 3.75" required>
                </div>
                <div class="form-group">
                    <label for="post-status">Status</label>
                    <select id="post-status">
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <button type="submit" class="btn">Kirim Data</button>
            </form>
            <div id="response-post"></div>
        </div>

        <div class="section">
            <h2>Update Pendaftar <span class="method-label">[PUT]</span></h2>
            <form id="form-put" onsubmit="updateApplication(event)">
                <div class="form-group">
                    <label for="put-id">ID Pendaftar</label>
                    <div class="id-row">
                        <input type="number" id="put-id" placeholder="masukkan ID" min="1" required>
                        <button type="button" class="btn" onclick="loadApplication()">Load</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="put-student-name">Nama Mahasiswa</label>
                    <input type="text" id="put-student-name" placeholder="Nama baru">
                </div>
                <div class="form-group">
                    <label for="put-student-id">NIM</label>
                    <input type="text" id="put-student-id" placeholder="NIM baru">
                </div>
                <div class="form-group">
                    <label for="put-course-name">Mata Kuliah</label>
                    <input type="text" id="put-course-name" placeholder="Mata kuliah baru">
                </div>
                <div class="form-group">
                    <label for="put-gpa">IPK</label>
                    <input type="number" id="put-gpa" step="0.01" min="0" max="4" placeholder="IPK baru">
                </div>
                <div class="form-group">
                    <label for="put-status">Status</label>
                    <select id="put-status">
                        <option value="">-- Tidak diubah --</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <button type="submit" class="btn">Update Data</button>
            </form>
            <div id="response-put"></div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = '/api/v1/applications';

    function renderResponse(containerId, status, data, isError) {
        var container = document.getElementById(containerId);
        var jsonStr = JSON.stringify(data, null, 2);
        container.innerHTML = '<div class="response-box">' +
            '<strong>Status: ' + status + '</strong>\n' + jsonStr + '</div>';
    }

    function getAllApplications() {
        var btn = document.getElementById('btn-get');
        btn.innerText = 'Loading...';
        btn.disabled = true;

        axios.get(BASE_URL)
            .then(function(response) {
                var result = response.data;
                var apps = result.data || [];

                if (apps.length === 0) {
                    document.getElementById('table-wrapper').innerHTML =
                        '<p class="empty-msg">Belum ada data pendaftar.</p>';
                } else {
                    var html = '<table><thead><tr>' +
                        '<th>ID</th><th>Nama</th><th>NIM</th><th>Mata Kuliah</th><th>IPK</th><th>Status</th><th>Dibuat</th>' +
                        '</tr></thead><tbody>';

                    for (var i = 0; i < apps.length; i++) {
                        var app = apps[i];
                        html += '<tr>' +
                            '<td>' + app.id + '</td>' +
                            '<td>' + app.student_name + '</td>' +
                            '<td>' + app.student_id + '</td>' +
                            '<td>' + app.course_name + '</td>' +
                            '<td>' + app.gpa + '</td>' +
                            '<td>' + app.status + '</td>' +
                            '<td>' + new Date(app.created_at).toLocaleDateString('id-ID') + '</td>' +
                            '</tr>';
                    }
                    html += '</tbody></table>';
                    document.getElementById('table-wrapper').innerHTML = html;
                }
                renderResponse('response-get', response.status, result, false);
            })
            .catch(function(error) {
                var errData = error.response ? error.response.data : { message: error.message };
                var errStatus = error.response ? error.response.status : 'Network Error';
                document.getElementById('table-wrapper').innerHTML =
                    '<p class="empty-msg">Gagal memuat data.</p>';
                renderResponse('response-get', errStatus, errData, true);
            })
            .finally(function() {
                btn.innerText = 'Ambil Semua Data';
                btn.disabled = false;
            });
    }

    function createApplication(event) {
        event.preventDefault();
        var btn = document.querySelector('#form-post button[type="submit"]');
        btn.innerText = 'Mengirim...';
        btn.disabled = true;

        var payload = {
            student_name: document.getElementById('post-student-name').value,
            student_id: document.getElementById('post-student-id').value,
            course_name: document.getElementById('post-course-name').value,
            gpa: parseFloat(document.getElementById('post-gpa').value),
            status: document.getElementById('post-status').value
        };

        axios.post(BASE_URL, payload)
            .then(function(response) {
                renderResponse('response-post', response.status, response.data, false);
                document.getElementById('form-post').reset();
                getAllApplications();
            })
            .catch(function(error) {
                var errData = error.response ? error.response.data : { message: error.message };
                var errStatus = error.response ? error.response.status : 'Network Error';
                renderResponse('response-post', errStatus, errData, true);
            })
            .finally(function() {
                btn.innerText = 'Kirim Data';
                btn.disabled = false;
            });
    }

    function loadApplication() {
        var id = document.getElementById('put-id').value;
        if (!id) { alert('Masukkan ID terlebih dahulu'); return; }

        axios.get(BASE_URL + '/' + id)
            .then(function(response) {
                var app = response.data.data;
                document.getElementById('put-student-name').value = app.student_name || '';
                document.getElementById('put-student-id').value = app.student_id || '';
                document.getElementById('put-course-name').value = app.course_name || '';
                document.getElementById('put-gpa').value = app.gpa || '';
                document.getElementById('put-status').value = app.status || '';
            })
            .catch(function(error) {
                var errData = error.response ? error.response.data : { message: error.message };
                var errStatus = error.response ? error.response.status : 'Network Error';
                renderResponse('response-put', errStatus, errData, true);
            });
    }

    function updateApplication(event) {
        event.preventDefault();
        var id = document.getElementById('put-id').value;
        if (!id) { alert('Masukkan ID terlebih dahulu'); return; }

        var btn = document.querySelector('#form-put button[type="submit"]');
        btn.innerText = 'Updating...';
        btn.disabled = true;

        var payload = {};
        var name = document.getElementById('put-student-name').value;
        var sid = document.getElementById('put-student-id').value;
        var course = document.getElementById('put-course-name').value;
        var gpa = document.getElementById('put-gpa').value;
        var status = document.getElementById('put-status').value;

        if (name) payload.student_name = name;
        if (sid) payload.student_id = sid;
        if (course) payload.course_name = course;
        if (gpa) payload.gpa = parseFloat(gpa);
        if (status) payload.status = status;

        axios.put(BASE_URL + '/' + id, payload)
            .then(function(response) {
                renderResponse('response-put', response.status, response.data, false);
                getAllApplications();
            })
            .catch(function(error) {
                var errData = error.response ? error.response.data : { message: error.message };
                var errStatus = error.response ? error.response.status : 'Network Error';
                renderResponse('response-put', errStatus, errData, true);
            })
            .finally(function() {
                btn.innerText = 'Update Data';
                btn.disabled = false;
            });
    }
</script>

</body>
</html>
