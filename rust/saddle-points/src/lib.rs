pub fn find_saddle_points(input: &[Vec<u64>]) -> Vec<(usize, usize)> {
    let mut saddle_points = Vec::new();
    for (y, row) in input.iter().enumerate() {
        for (x, value) in row.iter().enumerate() {
            let lt_row = row.iter().any(|v| value < v);
            let gt_col = (0..input.len()).any(|v| *value > input[v][x]);

            if !(lt_row || gt_col) {
                saddle_points.push((y, x));
            }
        }
    }
    saddle_points
}
