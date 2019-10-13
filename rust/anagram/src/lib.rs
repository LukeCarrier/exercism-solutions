use std::collections::{HashSet};

pub fn sort_chars(word: &str) -> Vec<char> {
    let mut result = word
        .to_lowercase()
        .chars()
        .collect::<Vec<_>>();
    result.sort();
    result
}

pub fn anagrams_for<'a>(word: &str, possible_anagrams: &'a[&str]) -> HashSet<&'a str> {
    let lower = word.to_lowercase();
    let sorted = sort_chars(word);
    possible_anagrams
        .iter()
        .filter(|a| a.to_lowercase() != lower && sort_chars(a) == sorted)
        .map(|a| *a)
        .collect()
}
