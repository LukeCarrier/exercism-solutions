pub fn raindrops(n: u32) -> String {
    let mut parts = Vec::<String>::with_capacity(3);

    if n % 3 == 0 {
        parts.push("Pling".to_string());
    }
    if n % 5 == 0 {
        parts.push("Plang".to_string());
    }
    if n % 7 == 0 {
        parts.push("Plong".to_string());
    }

    if parts.is_empty() {
        parts.push(n.to_string());
    }

    parts.join("")
}
