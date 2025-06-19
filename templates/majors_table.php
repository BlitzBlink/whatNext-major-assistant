<div class="table-container">
    <?php if (empty($current_items)): ?>
        <div class="no-results">
            <?php if (!empty($search)): ?>
                No majors found matching "<?php echo htmlspecialchars($search); ?>"
            <?php else: ?>
                No majors found
            <?php endif; ?>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr class="header-row">
                    <th colspan="3">
                        <div class="table-header">
                            <div class="search-container">
                                <form method="GET">
                                    <input type="text"
                                        name="search"
                                        class="search-input"
                                        placeholder="Search majors..."
                                        value="<?php echo htmlspecialchars($search); ?>">
                                    <button type="submit" class="button button-secondary">Search</button>
                                    <?php if (!empty($search)): ?>
                                        <a href="?" class="clear-btn">Clear</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                            <a href="add_major.php" class="button button-primary add-button">
                                <img src="/whatnext/public/assets/images/icon-add.svg" class="add-icon" />
                                Add Major
                            </a>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Major</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($current_items as $index => $major): ?>
                    <tr class="<?php echo ($index % 2 == 0) ? 'row-green' : 'row-white'; ?>">
                        <td><?php echo htmlspecialchars($major['major_id']); ?></td>
                        <td><?php echo htmlspecialchars($major['name']); ?></td>
                        <td>
                            <a href="edit_major.php?id=<?php echo $major['major_id']; ?>" class="action-btn edit-btn">
                                <img src="/whatnext/public/assets/images/icon-edit-purple.svg" class="edit-icon" />
                            </a>
                            <a href="delete_major.php?id=<?php echo $major['major_id']; ?>"
                                class="action-btn delete-btn"
                                onclick="return confirm('Are you sure you want to delete this major?')">
                                <img src="/whatnext/public/assets/images/icon-delete.svg" class="delete-icon" />
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php
        $query_params = $_GET;
        unset($query_params['page']);
        $query_string = http_build_query($query_params);
        $query_string = $query_string ? '&' . $query_string : '';
        ?>

        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?><?php echo $query_string; ?>" class="button button-secondary">Previous</a>
        <?php else: ?>
            <span class="button disabled">Previous</span>
        <?php endif; ?>

        <?php
        $start_page = max(1, $current_page - 2);
        $end_page = min($total_pages, $current_page + 2);

        if ($start_page > 1): ?>
            <a href="?page=1<?php echo $query_string; ?>">1</a>
            <?php if ($start_page > 2): ?>
                <span>...</span>
            <?php endif;
        endif;

        for ($i = $start_page; $i <= $end_page; $i++): ?>
            <?php if ($i == $current_page): ?>
                <span class="current"><?php echo $i; ?></span>
            <?php else: ?>
                <a href="?page=<?php echo $i; ?><?php echo $query_string; ?>"><?php echo $i; ?></a>
            <?php endif;
        endfor;

        if ($end_page < $total_pages): ?>
            <?php if ($end_page < $total_pages - 1): ?>
                <span>...</span>
            <?php endif; ?>
            <a href="?page=<?php echo $total_pages; ?><?php echo $query_string; ?>"><?php echo $total_pages; ?></a>
        <?php endif; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?><?php echo $query_string; ?>" class="button button-primary">Next</a>
        <?php else: ?>
            <span class="disabled button button-primary">Next</span>
        <?php endif; ?>
    </div>
<?php endif; ?>