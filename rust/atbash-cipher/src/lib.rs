pub fn toggle(text: &str) -> String {
    text
        .chars()
        .filter(|c| !c.is_whitespace() && char::is_ascii_alphanumeric(c))
        .map(|c| c.to_ascii_lowercase())
        .map(|c| {
            if c.is_ascii_alphabetic() {
                ((b'a' + b'z') - (c as u8)) as char
            } else {
                c
            }
        })
        .collect::<String>()
}

pub fn encode(plain: &str) -> String {
    toggle(plain)
        .chars()
        .enumerate()
        .map(|(i, c)| {
            if i % 5 == 0 {
                vec![' ', c]
            } else {
                vec![c]
            }.into_iter()
        })
        .flatten()
        .skip(1)
        .collect::<String>()
}

pub fn decode(cipher: &str) -> String {
    toggle(cipher)
}
