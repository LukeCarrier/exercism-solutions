const OPEN_BRACKET: &str = "[{(";
const CLOSE_BRACKET: &str = "]})";

pub fn brackets_are_balanced(string: &str) -> bool {
    let mut stack = Vec::new();
    string
        .chars()
        .filter(|&c| OPEN_BRACKET.find(c).is_some() || CLOSE_BRACKET.find(c).is_some())
        .all(|c| {
            if let Some(open) = OPEN_BRACKET.find(c) {
                stack.push(open);
                true
            } else {
                stack.pop() == CLOSE_BRACKET.find(c)
            }
        }) && stack.is_empty()
}
