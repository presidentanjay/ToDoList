<?php
function tampilkanDaftar(array $tasks): void {
    echo '<table>';
    echo '<thead><tr><th>Status</th><th>Judul Tugas</th><th>Aksi</th></tr></thead><tbody>';

    foreach ($tasks as $index => $task) {
        $checked     = $task['status'] === 'selesai' ? 'checked' : '';
        $statusClass = $task['status'] === 'selesai' ? 'selesai' : 'belum';
        $statusText  = $task['status'] === 'selesai' ? 'Selesai' : 'Belum Selesai';

        echo "<tr>";

        // Kolom status (checkbox + label)
        echo "<td>
                <form method='post' class='status-form'>
                    <input type='hidden' name='toggle_index' value='$index'>
                    <input type='checkbox' onchange='this.form.submit()' $checked>
                    <span class='task-status $statusClass'>$statusText</span>
                </form>
              </td>";

        // Kolom judul tugas
        echo "<td>" . htmlspecialchars($task['judul']) . "</td>";

        // Kolom aksi (hapus)
        echo "<td>
                <form method='post' onsubmit='return confirm(\"Hapus tugas ini?\")'>
                    <input type='hidden' name='hapus_index' value='$index'>
                    <button type='submit' class='btn-hapus'>Hapus</button>
                </form>
              </td>";

        echo "</tr>";
    }

    echo '</tbody></table>';
}
