<?php
function getPaginatedSearchResults($conn, $table, $joins, $search_columns, $search, $page, $limit = 5, $order_by = 'id DESC') {
    $search_escaped = $conn->real_escape_string($search);
    $offset = ($page - 1) * $limit;

    // Build WHERE clause
    $search_clauses = [];
    foreach ($search_columns as $col) {
        $search_clauses[] = "$col LIKE '%$search_escaped%'";
    }
    $where_clause = implode(" OR ", $search_clauses);

    // Build JOIN clause
    $join_clause = implode(" ", $joins);

    // Count total
    $count_sql = "SELECT COUNT(*) as total FROM $table $join_clause WHERE $where_clause";
    $total = $conn->query($count_sql)->fetch_assoc()['total'];
    $total_pages = ceil($total / $limit);

    // Get paginated data
    $data_sql = "SELECT * FROM $table $join_clause WHERE $where_clause ORDER BY $order_by LIMIT $limit OFFSET $offset";
    $result = $conn->query($data_sql);

    return [
        'result' => $result,
        'total' => $total,
        'total_pages' => $total_pages,
        'current_page' => $page
    ];
}
