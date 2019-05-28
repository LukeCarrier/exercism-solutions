enum MessageType {
    Silence,
    Question,
    Statement,
}

impl MessageType {
    fn new(message: &str) -> Self {
        if message.trim().is_empty() {
            MessageType::Silence
        } else if message.trim_end().ends_with('?') {
            MessageType::Question
        } else {
            MessageType::Statement
        }
    }
}

enum MessageTone {
    Normal,
    Shouted,
}

impl MessageTone {
    fn new(message: &str) -> Self {
        let mut chars = message.chars().filter(|c| c.is_alphabetic()).peekable();
        let letters = chars.peek().is_some();
        let all_upper = chars.all(char::is_uppercase);

        if letters && all_upper {
            MessageTone::Shouted
        } else {
            MessageTone::Normal
        }
    }
}

pub fn reply(message: &str) -> &str {
    let msg_type = MessageType::new(message);
    let msg_tone = MessageTone::new(message);

    match (msg_type, msg_tone) {
        (MessageType::Question, MessageTone::Shouted) => "Calm down, I know what I'm doing!",
        (MessageType::Question, _) => "Sure.",
        (MessageType::Silence, _) => "Fine. Be that way!",
        (_, MessageTone::Shouted) => "Whoa, chill out!",
        _ => "Whatever.",
    }
}
