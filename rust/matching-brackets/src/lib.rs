use std::collections::HashMap;

static OPEN_BRACKET: [char; 3] = ['[', '{', '('];
static CLOSE_BRACKET: [char; 3] = [']', '}', ')'];

pub fn brackets_are_balanced(string: &str) -> bool {
    let mut pairs = HashMap::new();
    pairs.insert(OPEN_BRACKET[0], CLOSE_BRACKET[0]);
    pairs.insert(OPEN_BRACKET[1], CLOSE_BRACKET[1]);
    pairs.insert(OPEN_BRACKET[2], CLOSE_BRACKET[2]);

    let brackets = string
        .chars()
        .filter(|c| OPEN_BRACKET.contains(c) || CLOSE_BRACKET.contains(c));

    let mut stack = Vec::new();
    for bracket in brackets {
        if OPEN_BRACKET.contains(&bracket) {
            stack.push(bracket);
        } else if !stack.is_empty() && pairs[stack.last().unwrap()] == bracket {
            stack.pop();
        } else {
            return false;
        }
    }
    stack.is_empty()
}
