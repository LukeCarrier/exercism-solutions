pub fn toggle(text: &str) -> String {
    text
        .chars()
        .filter(|c| c.is_ascii_alphanumeric())
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
        .flat_map(|(i, c)| {
            if i % 5 == 0 {
                vec![' ', c]
            } else {
                vec![c]
            }.into_iter()
        })
        .skip(1)
        .collect::<String>()
}

pub fn decode(cipher: &str) -> String {
    toggle(cipher)
}
